<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GeneralController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("User_model");
		$this->load->model("Pin_model");
	}

	public function index()
	{
		if (!empty($_SESSION['user'])) {
			$data['emparray'] = $this->Pin_model->getByUser($_SESSION['user']);
		} else {
			$data['emtpy'] = [];
		}

		$this->load->view('template/header.php', $data);
		$this->load->view('template/navbar.php', $data);
		$this->load->view('index', $data);
	}

	public function peta_indonesia()
	{
		if (!empty($_SESSION['user'])) {
			$data['emparray'] = $this->Pin_model->getByUser($_SESSION['user']);
		} else {
			$data['emtpy'] = [];
		}

		$this->load->view('template/header.php');
		$this->load->view('template/navbar.php');
		$this->load->view('indonesia-map', $data);
	}

	public function register()
	{
		$user = $_POST['username'];
		$pw = $_POST['password'];
		$cpw = $_POST['confirm_password'];

		$data = $this->User_model->getByUsername($_POST['username']);

		if ($data == NULL) {
			if ($pw == $cpw) {
				echo "berhasil";
				$rpw = password_hash($pw, PASSWORD_DEFAULT);
				$this->User_model->save();
				$_SESSION['success'] = "Register Berhasil, Silahkan Login!";
				redirect('/');
				exit();
			} else {
				$_SESSION['failed'] = "Konfirmasi password yang anda masukan tidak sama, Coba masukan kembali!";
				redirect('/');
				exit();
			}
		} else {
			$_SESSION['failed'] = "Username yang anda masukan, sudah tersedia, Coba kembali!";
			redirect('/');
			exit();
		}
	}

	public function login()
	{
		$user = $_POST['username'];
		$pw = $_POST['password'];

		$data = $this->User_model->getByUsername($user);

		if ($user == $data->username) {
			if (password_verify($pw, $data->password)) {
				session_start();
				$_SESSION['user'] = $user;
				$_SESSION['success'] = "Login Berhasil";
				redirect('/');
				exit();
			} else {
				$status = true;
			}
		} else {
			$status = true;
		}

		if ($status) {
			$_SESSION['failed'] = "Username/Password Salah!";
			redirect('/');
		}
	}

	public function ganti_password()
	{
		var_dump($_POST);

		$data = $this->User_model->getByUsername($_SESSION['user']);

		if ($_POST['pw'] != $_POST['cpw']) {
			$_SESSION['failed'] = "Password baru dan konfirmasi password berbeda, silahkan coba lagi!";
			redirect('/');
			exit();
		}

		if (!password_verify($_POST['pl'], $data->password)) {
			$_SESSION['failed'] = "Password lama salah, coba lagi!";
			redirect('/');
			exit();
		}

		$this->User_model->ganti_password($data->id);
		$this->logout();
	}

	public function logout()
	{
		unset($_SESSION['user']);

		if ($_GET['logout'] == "cpw") {
			$_SESSION['success'] = "Ubah password berhasil, silahkan login ulang!";
		} else {
			$_SESSION['success'] = "Logout berhasil!";
		}

		redirect('/');
	}


	public function hapus_marker()
	{
		$rs = $this->Pin_model->delete($_GET['id']);

		if ($rs) {
			$_SESSION['success'] = "Hapus pin berhasil!";
			redirect('/');
		} else {
			$_SESSION['failed'] = "Tambah pin gagal!";
			redirect('/');
		}
	}

	public function tambah_marker()
	{
		$pin = $_GET['pin'];
		$nama = $_GET['nama'];
		$pin = str_replace('LngLat(', '', $pin);
		$pin = str_replace(')', '', $pin);
		$arr = explode(" ", $pin);
		$lng = str_replace(',', '', $arr[0]);
		$lnt = str_replace(',', '', $arr[1]);
		$user_name = $_SESSION['user'];
		$rs = $this->Pin_model->save([
			'lng' => $lng,
			'lnt' => $lnt,
			'nama' => $nama,
			'user_name' => $user_name
		]);

		if ($rs) {
			$_SESSION['success'] = "Tambah pin berhasil!";
			redirect('/');
		} else {
			$_SESSION['failed'] = "Tambah pin gagal!";
			redirect('/');
		}
	}
}
