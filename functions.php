<?php
session_start();

include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'includes/saw.php';
include 'includes/paging.php';
date_default_timezone_set('Asia/Jakarta');

function _post($key, $val = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];
    else
        return $val;
}

function _get($key, $val = null)
{
    global $_GET;
    if (isset($_GET[$key]))
        return $_GET[$key];
    else
        return $val;
}

function _session($key, $val = null)
{
    global $_SESSION;
    if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    else
        return $val;
}

$mod = _get('m');
$act = _get('act');

// $db->query("DELETE FROM tb_hasil WHERE kode_periode NOT IN (SELECT kode_periode FROM tb_periode)");
// $db->query("DELETE FROM tb_hasil WHERE kode_siswa NOT IN (SELECT kode_siswa FROM tb_siswa)");

$db->query("DELETE FROM tb_crisp WHERE kode_kriteria NOT IN (SELECT kode_kriteria FROM tb_kriteria)");

$db->query("DELETE FROM tb_rel_siswa WHERE kode_kriteria NOT IN (SELECT kode_kriteria FROM tb_kriteria)");
$db->query("DELETE FROM tb_rel_siswa WHERE kode_siswa NOT IN (SELECT kode_siswa FROM tb_siswa)");

// $db->query("DELETE FROM tb_siswa WHERE kode_periode NOT IN (SELECT kode_periode FROM tb_periode)");

$rows = $db->get_results("SELECT * FROM tb_crisp ORDER BY kode_kriteria, nilai");
$CRISP = array();
foreach ($rows as $row) {
    $CRISP[$row->kode_crisp] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_siswa s LEFT JOIN tb_kelas k ON k.kode_kelas=s.kode_kelas ORDER BY kode_siswa");
$SISWA = array();
foreach ($rows as $row) {
    $SISWA[$row->kode_siswa] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_periode ORDER BY kode_periode");
$PERIODE = array();
foreach ($rows as $row) {
    $PERIODE[$row->kode_periode] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_kriteria ORDER BY kode_kriteria");
$KRITERIA = array();
foreach ($rows as $row) {
    $KRITERIA[$row->kode_kriteria] = $row;
}

$rows = $db->get_results("SELECT * FROM tb_kelas ORDER BY kode_kelas");
$KELAS = array();
foreach ($rows as $row) {
    $KELAS[$row->kode_kelas] = $row;
}

function get_rel_siswa($kode_periode)
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_siswa WHERE kode_periode='$kode_periode' ORDER BY kode_siswa, kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_siswa][$row->kode_kriteria] = $row->kode_crisp;
    }
    return $arr;
}

function get_rel_siswa_file($kode_periode)
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_siswa WHERE kode_periode='$kode_periode' ORDER BY kode_siswa, kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_siswa][$row->kode_kriteria] = ["a"=>$row->kode_crisp,"b"=>$row->file];
    }
    return $arr;
}

function get_rel_status($kode_periode)
{
    global $db;
    $rows = $db->get_results("SELECT * FROM tb_rel_siswa WHERE kode_periode='$kode_periode' ORDER BY kode_siswa, kode_kriteria");
    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_siswa] = $row->status_rel_siswa;
    }
    return $arr;
}

function get_atribut_option($selected = '')
{
    $atribut = array('benefit' => 'Benefit', 'cost' => 'Cost');
    $a = '';
    foreach ($atribut as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = (string) $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function esc_field($str)
{
    return addslashes($str);
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        ' . $msg . '
    </div>';
}

function get_level_option($selected = '')
{
    $a = '';
    $level = array('admin' => 'Admin', 'user' => 'User');
    foreach ($level as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_jk_option($selected = '')
{
    $a = '';
    $jk = array('Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan');
    foreach ($jk as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_aktif_option($selected = '')
{
    $a = '';
    $jk = array('Aktif' => 'Aktif', 'NonAktif' => 'NonAktif');
    foreach ($jk as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_status_option($selected = '')
{
    $a = '';
    $arr = array('Acc' => 'Acc', 'Pending' => 'Pending');
    foreach ($arr as $key => $value) {
        if ($selected == $key)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_kriteria_option($selected = "")
{
    global $KRITERIA;
    $a = '';
    foreach ($KRITERIA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_kriteria</option>";
        else
            $a .= "<option value='$key'>$val->nama_kriteria</option>";
    }
    return $a;
}

function get_kelas_option($selected = "")
{
    global $KELAS;
    $a = '';
    foreach ($KELAS as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_kelas</option>";
        else
            $a .= "<option value='$key'>$val->nama_kelas</option>";
    }
    return $a;
}

function get_periode_option($selected = "", $only_active = false)
{
    global $PERIODE;
    $a = '';
    foreach ($PERIODE as $key => $val) {
        if ($only_active && $val->status_periode != 'Aktif')
            continue;
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_periode</option>";
        else
            $a .= "<option value='$key'>$val->nama_periode</option>";
    }
    return $a;
}

function get_periode_check($selected = "", $only_active = false)
{
    global $PERIODE;
    $a = '';
    foreach ($PERIODE as $key => $val) {
        if ($only_active && $val->status_periode != 'Aktif')
            continue;
        if ($key == $selected)
        $a .= '<div class="form-check form-check-inline">
                <input name="periode[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="'.$key.'" checked>
                <label class="form-check-label" for="inlineCheckbox1">'.$val->nama_periode.'</label>
            </div>';
        else
            $a .= '<div class="form-check form-check-inline">
                <input name="periode[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="'.$key.'">
                <label class="form-check-label" for="inlineCheckbox1">'.$val->nama_periode.'</label>
            </div>';
    }
    return $a;
}

function get_siswa_option($selected = "")
{
    global $SISWA;
    $a = '';
    foreach ($SISWA as $key => $val) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$val->nama_siswa</option>";
        else
            $a .= "<option value='$key'>$val->nama_siswa</option>";
    }
    return $a;
}

function get_crisp_option($kode_kriteria, $selected = "")
{
    global $CRISP;
    $a = '';
    foreach ($CRISP as $key => $val) {
        if ($val->kode_kriteria == $kode_kriteria) {
            if ($val->kode_crisp == $selected)
                $a .= "<option value='$val->kode_crisp' selected>$val->nama_crisp</option>";
            else
                $a .= "<option value='$val->kode_crisp'>$val->nama_crisp</option>";
        }
    }
    return $a;
}
function set_msg($msg, $type = 'success')
{
    $_SESSION['message'] = array('msg' => $msg, 'type' => $type);
}

function show_msg()
{
    if (!_session('message'))
        return null;

    if ($_SESSION['message'])
        print_msg($_SESSION['message']['msg'], $_SESSION['message']['type']);
    unset($_SESSION['message']);
}

function dd($arr)
{
    echo '<pre>' . print_r($arr, 1) . '</pre>';
}

function get_rel_nilai($rel_siswa)
{
    global $CRISP;
    $arr = array();
    foreach ($rel_siswa as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = isset($CRISP[$v]) ? $CRISP[$v]->nilai : 0;
        }
    }
    return $arr;
}
