<?php
use Carbon\Carbon;

/*
 *
 * fielf_required
 * Show a * if field is required
 *
 * ------------------------------------------------------------------------
 */

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

if (!function_exists('setting')) {
  function setting($key, $default = null)
  {
    if (is_null($key)) {
      return new Setting();
    }

    if (is_array($key)) {
      return Setting::set($key[0], $key[1]);
    }

    $value = Setting::get($key);
    return is_null($value) ? value($default) : $value;
  }
}
if (!function_exists('fielf_required')) {

  /**
   * Prepare the Column Name for Lables.
   */
  function fielf_required($required)
  {
    $return_text = '';

    if ($required != '') {
      $return_text = '<span class="text-danger">*</span>';
    }

    return $return_text;
  }
}

if (!function_exists('get_approval_text')) {

  /**
   * Prepare the Column Name for Lables.
   */
  function get_approval_text($approval_id)
  {
    $approvals = ['Batal', 'Menunggu Approval Penyelia', 'Menunggu Approval SDM', 'Menunggu Koordinator', 'Terkonfirmasi', 'Proses', 'Selesai'];
    return $approvals[$approval_id];
  }
}

if (!function_exists('transaction')) {
  /**
   * Make a wrapper for try and caching and error
   * @param Function $resolve
   */
  function transaction($resolve)
  {
    DB::beginTransaction();
    try {
      $resolve();
      DB::commit();
    } catch (\Exception $e) {
      Log::emergency("Exception Message: " . $e->getMessage()  . " File: " . $e->getFile() . " Line: " . $e->getLine());
      DB::rollback();
    }
  }
}

if (!function_exists('transaction_store')) {
  /**
   * MWrapper for storing data
   * @param Function $callback
   */
  function transaction_store($callback)
  {
    transaction(function () use ($callback) {
      $callback();
      $backfiles = debug_backtrace();
      Log::info("Store: File : " . $backfiles[0]['file'] . " Line: " . $backfiles[0]['line']);
    });
  }
}

if (!function_exists('helperCreateTransNumber')) {
  function helperCreateTransNumber($prefix = '')
  {
    return uniqid($prefix);
  }
}

if (!function_exists('helperCamelize')) {
  function helperCamelize($input, $separator = '_')
  {
    $str = str_replace($separator, '', ucwords($input, $separator));
    return lcfirst($str);
  }
}

if (!function_exists('helperCamelizeArray')) {
  function helperCamelizeArray($arr)
  {
    $data = [];
    foreach ($arr as $key => $value) {
      $attr = helperCamelize($key);
      $data[$attr] = $value;
    }
    return $data;
  }
}

if (!function_exists('helperParseCurrency')) {
  function helperParseCurrency($currencyString)
  {
    return intval(implode("", explode(",", $currencyString)));
  }
}

if (!function_exists('helperFormatDate')) {
  function helperFormatDate($date, $format='d/m/Y') {
    return $date ? Carbon::parse($date)->format($format) : "-";
  }
}



