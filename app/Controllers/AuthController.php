<?php

namespace App\Controllers;
use App\Models\barang\Barang;
use App\Models\barang\Stok;
use App\Models\barang\Pengiriman;
use App\Models\barang\CatatanLaporan;
use App\Models\barang\Penerimaan;
use App\Models\barang\BarangKeluar;
use App\Models\barang\Lokasi;
use App\Models\barang\User;
use CodeIgniter\I18n\Time;

/**
 * ------------------------------
 * Auth Controller
 * ------------------------------
 * This Controller is using to manage authentication
 * You must be know something different of this Controller
 * All the public function is using return redirect()->to($routes)
 * Is making you easier to set your message with session()->setFlashdata()
 */

class AuthController extends TamhorAuth
{
    public function __construct()
    {
        $this->session = session();
        $this->barang = new Barang();
        $this->stok = new Stok;
        $this->pengiriman = new Pengiriman();
        $this->catatan_laporan = new CatatanLaporan();
        $this->barang_keluar = new BarangKeluar();
        $this->penerimaan = new Penerimaan();
        $this->lokasi = new Lokasi();
        $this->user = new User();
        $this->request = \Config\Services::request(); //memanggil class request

        $this->db= \Config\Services::connect();


        $model = model(User::class);
        

    }
    public function register()
    {
        $rules = [
            'fullname' => 'required|min_length[3]|max_length[20]',
            'email' => [
                'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.username]',
                'errors' => [
                    'is_unique' => 'This email address already registered.'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[6]|max_length[200]|is_unique[user.username]',
                'errors' => [
                    'is_unique' => 'This Username already use.'
                ]
            ],
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'fullname'     => $this->request->getVar('fullname'),
                'email'    => $this->request->getVar('email'),
                'username'    => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'activate_token'    => $this->key(),
            ];
            $insert_ok = $this->users->save($data);

            if ($insert_ok == true) {

                $message = "Please activate the account " . anchor('activate/' . $data['activate_token'], 'Activate Now', '');

                $sending = $this->sendEmail($data['email'], 'Activate the account', $message);

                if ($sending == true) {
                    $this->session->setFlashdata('msg', $this->success(
                        "You've been Registered. Check your email for activation.",
                        "This page will be automatically redirect to login page."
                    ));
                    return redirect()->to('/register');
                } else {
                    $this->session->setFlashdata('msg', $this->errors(
                        "You've been Registered. <br/> But cant send you activation email right now.",
                        "Contact the administrator."
                    ));
                    return redirect()->to('/register');
                }
            } else {
                $this->session->setFlashdata('msg', $this->errors(
                    "You cannot to register right now.",
                    "Contact the administrator.</p></div>"
                ));
                return redirect()->to('/register');
            }
        } else {

            $this->session->setFlashdata('msg', $this->validator->listErrors());
            return redirect()->to('/register');
        }
    }

    public function activate($activate_key)
    {
        $data = $this->users->where('activate_token', $activate_key)->first();
        if ($data != null) {

            $update = [
                'is_active' => 1,
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ];

            $this->users->where(['email' => $data['email'], 'activate_token' => $data['activate_token']]);
            $this->users->set($update);
            $activate_user = $this->users->update();

            if ($activate_user) {
                $this->activation->save([
                    'user_id' => $data['id'],
                    'token' => $data['activate_token'],
                    'created_at' => Time::now()
                ]);
                $this->session->setFlashdata(
                    'msg',
                    $this->success(
                        "Your account has been Activated. ",
                        "Lets Rock's!!!"
                    )
                );
                return redirect()->to('/login');
            }
        } else {
            $this->session->setFlashdata(
                'msg',
                $this->errors(
                    "Your activation token is invalid. ",
                    "Check link on your inbox!"
                )
            );
            return redirect()->to('/login');
        }
    }

    public function login()
    {
        $input = $this->request->getVar('input');
        $password = $this->request->getVar('password');
        $data = $this->users->where('email', $input)->orWhere('username', $input)->first();

        if ($data != null) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                if ($data['is_active'] == 0) {
                    $message = "Please activate the account " . anchor('activate/' . $data['activate_token'], 'Activate Now', '');
                    $this->session->setFlashdata(
                        'msg',
                        $this->errors(
                            "Your account not verified.<br/>Check your email to activate your account.",
                            "Your activation link is automatically resend to your email"
                        )
                    );
                    $this->sendEmail($data['email'], 'Activate the account', $message);
                    return redirect()->to('/login');
                } else {
                    $sess_data = [
                        'id'       => $data['id'],
                        'email'     => $data['email'],
                        'username'    => $data['username'],
                        'logged_in'     => TRUE
                    ];
                    $this->session->set($sess_data);
                    return redirect()->to('/');
                }
            } else {
                $this->session->setFlashdata(
                    'msg',
                    $this->errors(
                        'Wrong Password'
                    )
                );
                return redirect()->to('/login');
            }
        } else {
            $this->session->setFlashdata(
                'msg',
                $this->errors(
                    'Email / Username not Found'
                )
            );
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        $this->session->setFlashdata('msg', 'Your logout');
        return redirect()->to('/login');
    }

    public function forgot_password()
    {
        $email = $this->request->getVar('email');
        $data = $this->users->where('email', $email)->first();

        if ($data != null) {
            $this->users->where('email', $data['email']);
            $this->users->set('reset_token', $this->key());
            $reset_pass = $this->users->update();

            if ($reset_pass == true) {
                $data = $this->users->where('email', $email)->first();

                $message = "Set your new password " . anchor('recover-password/' . $data['reset_token'], 'Click here', '');

                $sending = $this->sendEmail($data['email'], 'Reset your password', $message);

                if ($sending == true) {
                    $this->session->setFlashdata(
                        'msg',
                        $this->success(
                            "You've token for reset password has been sent.",
                            "Check your email inbox."
                        )
                    );
                    return redirect()->to('/forgot-password');
                } else {
                    $this->session->setFlashdata(
                        'msg',
                        $this->errors(
                            "Your token reset cannot send right now.",
                            "Contact the administrator."
                        )
                    );
                    return redirect()->to('/forgot-password');
                }
            } else {
                $this->session->setFlashdata(
                    'msg',
                    $this->errors(
                        "You cannot reset your password.",
                        "Contact the administrator."
                    )
                );
                return redirect()->to('/forgot-password');
            }
        } else {
            $this->session->setFlashdata(
                'msg',
                $this->errors(
                    "This email not found.<br/> Are you sure has registered with this email?",
                    "Contact the administrator."
                )
            );
            return redirect()->to('/forgot-password');
        }
    }

    public function recover_view($recover_key)
    {
        $data = $this->users->where('reset_token', $recover_key)->first();

        if ($data != null) {
            $key = $data['reset_token'];
            echo view('auth/recover-password', compact('key'));
        } else {
            $this->session->setFlashdata(
                'msg',
                $this->errors(
                    "Your token is invalid.",
                    "Contact the administrator."
                )
            );
            return redirect()->to('/forgot-password');
        }
    }

    public function recover_password()
    {
        $key = $this->request->getVar('recovery_key');
        $data = $this->users->where('reset_token', $key)->first();

        $rules = [
            'password'      => 'required|min_length[6]|max_length[200]',
            'confpassword'  => 'matches[password]'
        ];
        if ($this->validate($rules)) {
            $update = [
                'password' => $this->request->getVar('password'),
                'updated_at' => Time::now()
            ];
            $this->users->where(['email' => $data['email'], 'reset_token' => $data['reset_token']]);
            $this->users->set($update);
            $update_pass = $this->users->update();
            if ($update_pass == true) {
                $resetpass->save([
                    'user_id' => $data['id'],
                    'token' => $data['reset_token'],
                    'created_at' => Time::now()
                ]);
                $this->session->setFlashdata(
                    'msg',
                    $this->success(
                        "Your password has been Updated.",
                        "Lets Rock's!!!"
                    )
                );
                return redirect()->to('/login');
            } else {
                $this->session->setFlashdata(
                    'msg',
                    $this->errors(
                        "Your password cannot Updated.",
                        "Contact the administrator."
                    )
                );
                return redirect()->to($this->recover_view($key));
            }
        } else {
            $this->session->setFlashdata('msg', $this->validator->listErrors());
            return redirect()->to($this->recover_view($key));
        }
    }
}
