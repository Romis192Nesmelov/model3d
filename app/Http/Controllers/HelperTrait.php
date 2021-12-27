<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use App\Models\User;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Settings;
use Illuminate\Support\Facades\Config;

trait HelperTrait
{
    private $validationEmail = 'required|email|unique:users,email';
    private $validationPhone = 'required|regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    private $validationSite = 'required|url';
    private $validationUser = 'required|integer|exists:users,id';
    private $validationIntField = 'required|integer';
    private $validationCharField = 'required|min:3|max:255';
    private $validationTextField = 'required|min:10|max:7000';
    private $validationPassword = 'required|confirmed|min:4|max:50';
    private $validationDate = ['required','regex:/^((([0-2][0-9])|(3[0-1]))\.((0[1-9])|([0-1][0-2]))\.((19\d{2})|(20[0-2][0-9])))$/'];
    private $validationTime = ['required','regex:/^((([0-1][0-9])|(2[0-4]))\.[0-5][0-9])$/'];
    private $validationImage = 'image|min:5|max:2000';
    private $validationSocNets = [
        'fb' => ['required','regex:/(?:https?:\/\/)?(?:www\.)?(mbasic.facebook|m\.facebook|facebook|fb)\.(com|me)\/(?:(?:\w\.)*#!\/)?(?:pages\/)?(?:[\w\-\.]*\/)*([\w\-\.]*)/'],
        'vk' => ['required','regex:/^(https?:\/\/(www\.)?vk\.com\/(\d|\w)+(\/)?)$/'],
        'inst' => ['required','regex:/^(https:\/\/www.instagram.com\/(\d|\w)+(\/)?)$/']
    ];
    private $metas = [
        'title' => ['name' => 'title', 'property' => false],
        'meta_description' => ['name' => 'description', 'property' => false],
        'meta_keywords' => ['name' => 'keywords', 'property' => false],
        'meta_twitter_card' => ['name' => 'twitter:card', 'property' => false],
        'meta_twitter_size' => ['name' => 'twitter:size', 'property' => false],
        'meta_twitter_creator' => ['name' => 'twitter:creator', 'property' => false],
        'meta_og_url' => ['name' => false, 'property' => 'og:url'],
        'meta_og_type' => ['name' => false, 'property' => 'og:type'],
        'meta_og_title' => ['name' => false, 'property' => 'og:title'],
        'meta_og_description' => ['name' => false, 'property' => 'og:description'],
        'meta_og_image' => ['name' => false, 'property' => 'og:image'],
        'meta_robots' => ['name' => 'robots', 'property' => false],
        'meta_googlebot' => ['name' => 'googlebot', 'property' => false],
        'meta_google_site_verification' => ['name' => 'robots', 'property' => false],
    ];
    private $phoneLeftSymbols = [' ','-','(',')'];

    
    private function validateCaptcha(Request $request)
    {
        if (!$this->reCaptchaRequest($request->input('g-recaptcha-response'))) {
            if ($request->ajax()) return response()->json(['errors' => ['g-recaptcha-response' => [trans('validation.captcha-error')]]], 404);
            else return redirect()->back()->withErrors(['g-recaptcha-response' => trans('validation.captcha-error')]);
        } else return false;
    }

    private function getItems(Model $model, $dataName=null)
    {
        $items = $model->where('active',1)->get();
        if ($dataName) {
            $this->data[$dataName] = $items;
            return true;
        } else return $items;
    }

    private function getItem(Request $request, Model $model, $slug=null, $itemName='item')
    {
        $item = null;
        if ($slug) $item = $model->where('slug',$slug)->where('active',1)->first();
        elseif ($request->has('id')) $item = $model->where('id',$request->input('id'))->where('active',1)->first();
        if (!$item) abort(404);
        $this->data[$itemName] = $item;
    }

//    private function masterMail()
//    {
//        return (string)Settings::getSettings()->email;
//    }

    private function randString()
    {
        return md5(rand(0,100000));
    }

    private function processingFields(Request $request, $checkboxFields=null, $ignoreFields=null, $timeFields=null, $colorFields=null)
    {
        $exceptFields = ['_token','id'];
        if ($ignoreFields) {
            if (is_array($ignoreFields)) $exceptFields = array_merge($exceptFields, $ignoreFields);
            else $exceptFields[] = $ignoreFields;
        }

//        $exceptFields = array_merge($exceptFields, $this->ignoringFields);
        $fields = $request->except($exceptFields);

        if ($checkboxFields) {
            if (is_array($checkboxFields) && count($checkboxFields)) {
                foreach ($checkboxFields as $field) {
                    $fields[$field] = isset($fields[$field]) && $fields[$field] == 'on' ? 1 : 0;
                }
            } else {
                $fields[$checkboxFields] = isset($fields[$checkboxFields]) && $fields[$checkboxFields] == 'on' ? 1 : 0;
            }
        }

        if ($timeFields) {
            if (is_array($timeFields) && count($timeFields)) {
                foreach ($timeFields as $field) {
//                    $fields[$field] = Carbon::createFromTimestamp($this->convertDate($fields[$field]))->toDateTimeString();
                    $fields[$field] = $this->convertDate($fields[$field]);
                }
            } else {
//                $fields[$timeFields] = Carbon::createFromTimestamp($this->convertDate($fields[$timeFields]))->toDateTimeString();
                $fields[$timeFields] = $this->convertDate($fields[$timeFields]);
            }
        }

        if ($colorFields) {
            if (is_array($colorFields) && count($colorFields)) {
                foreach ($colorFields as $field) {
                    $fields[$field] = $this->convertColor($fields[$field]);
                }
            } else {
                $fields[$colorFields] = $this->convertColor($fields[$colorFields]);
            }
        }
        
        foreach ($fields as $name => $value) {
            if ($value === '0') $fields[$name] = null;
        }
        
        return $fields;
    }

    private function processingImage(Request $request, Model $model=null, $field=null, $name=null, $path=null)
    {
        $imageField = [];
        $field = $field ? $field : 'image';
        
        if ($request->hasFile($field)) {
            $this->unlinkFile($model, $field);

            $info = $model && $model[$field] ? pathinfo($model[$field]) : null;
            
            if ($name) $imageName = $name.'.'.$request->file($field)->getClientOriginalExtension();
            elseif ($info) $imageName = $info['filename'].'.'.$request->file($field)->getClientOriginalExtension();
            else $imageName = $this->randString().'.'.$request->file($field)->getClientOriginalExtension();
            
            if (!$path && $info) $path = $info ? $info['dirname'] : 'images';

            $request->file($field)->move(base_path('public/'.$path),$imageName);
            $imageField[$field] = $path.'/'.$imageName;
        }
        return $imageField;
    }

    private function deleteSomething(Request $request, Model $model, $files=null, $children=null, $childrenFiles=null, $addValidation=null, $notValidate=false)
    {
        if (!$notValidate) {
            $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id'.($addValidation ? '|'.$addValidation : '')]);
            $table = $model->find($request->input('id'));
        } else $table = $model; 

        if ($children && $childrenFiles) {
            foreach ($table->$children as $child) {
                if (is_array($childrenFiles)) {
                    foreach ($childrenFiles as $file) {
                        $this->unlinkFile($child, $file);
                    }
                } else $this->unlinkFile($child, $files);
            }
        }

        if ($files) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->unlinkFile($table, $file);
                }
            } else $this->unlinkFile($table, $files);
        }

        $table->delete();
        return response()->json(['success' => true]);
    }

    private function unlinkFile($table, $file, $path='')
    {
        $fullPath = base_path('public/'.$path.$table[$file]);
        if (isset($table[$file]) && $table[$file] && file_exists($fullPath)) unlink($fullPath);
    }

    private function convertDate($date)
    {
        $date = explode('.', $date);
        return strtotime($date[1].'/'.$date[0].'/'.$date[2]);
    }
    
    private function convertTime($time)
    {
        $time = explode('.', $time);
        return (60 * 60 * $time[0]) + (60 * $time[1]);
    }

    private function getMoscowTimeZone($timestamp)
    {
        return $timestamp - (60 * 60 * 3);
    }

    private function convertColor($color)
    {
        if (preg_match('/^(hsv\(\d+\, \d+\%\, \d+\%\))$/',$color)) {
            $hsv = explode(',',str_replace(['hsv','(',')','%',' '],'',$color));
            $color = $this->fGetRGB($hsv[0],$hsv[1],$hsv[2]);
        }
        return $color;
    }

    private function fGetRGB($iH, $iS, $iV)
    {
        if($iH < 0)   $iH = 0;   // Hue:
        if($iH > 360) $iH = 360; //   0-360
        if($iS < 0)   $iS = 0;   // Saturation:
        if($iS > 100) $iS = 100; //   0-100
        if($iV < 0)   $iV = 0;   // Lightness:
        if($iV > 100) $iV = 100; //   0-100
        $dS = $iS/100.0; // Saturation: 0.0-1.0
        $dV = $iV/100.0; // Lightness:  0.0-1.0
        $dC = $dV*$dS;   // Chroma:     0.0-1.0
        $dH = $iH/60.0;  // H-Prime:    0.0-6.0
        $dT = $dH;       // Temp variable
        while($dT >= 2.0) $dT -= 2.0; // php modulus does not work with float
        $dX = $dC*(1-abs($dT-1));     // as used in the Wikipedia link
        switch(floor($dH)) {
            case 0:
                $dR = $dC; $dG = $dX; $dB = 0.0; break;
            case 1:
                $dR = $dX; $dG = $dC; $dB = 0.0; break;
            case 2:
                $dR = 0.0; $dG = $dC; $dB = $dX; break;
            case 3:
                $dR = 0.0; $dG = $dX; $dB = $dC; break;
            case 4:
                $dR = $dX; $dG = 0.0; $dB = $dC; break;
            case 5:
                $dR = $dC; $dG = 0.0; $dB = $dX; break;
            default:
                $dR = 0.0; $dG = 0.0; $dB = 0.0; break;
        }
        $dM  = $dV - $dC;
        $dR += $dM; $dG += $dM; $dB += $dM;
        $dR *= 255; $dG *= 255; $dB *= 255;
        return 'rgb('.(string)round($dR).', '.(string)round($dG).', '.(string)round($dB).')';
    }

    public function transliteration($string)
    {
        return str_replace('_',' ',str_slug($string));
    }

    public function sendMessage($destination, $template, array $fields, $copyTo=null, $pathToFile=null)
    {
        $title = (string)Settings::getSeoTags()['title'];
        Mail::send('auth.emails.'.$template, $fields, function($message) use ($title, $pathToFile, $destination, $copyTo) {
            $message->subject(trans('auth.message_from').$title);
            $message->from(env('MAIL_MASTER'), $title);
            $message->to($destination);
            if ($copyTo) $message->cc($copyTo);
            if ($pathToFile) $message->attach($pathToFile);
        });
    }
}