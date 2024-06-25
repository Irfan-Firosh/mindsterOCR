<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR as TesseractOCRTesseractOCR;

class testController extends Controller
{
    public function index() {
        $dir = '/Applications/XAMPP/xamppfiles/htdocs/ocr/public/imgs';
        $entries = scandir($dir);
        $ocr = new TesseractOCRTesseractOCR();
        $ret = ['text' => '', 'price' => '', 'desc' => ''];
        foreach ($entries as $entry) {
            if ($entry != '..' && $entry != '.') {
                $path = $dir . '/' . $entry;
                // Check if file has 'title' keyword in it
                /* if (substr_count($entry, 'title') > 0) {
                    $ocr->image($path)->lang('eng')->allowlist(range('A', 'Z'), range('a', 'z'), ' ', '\n');
                    $text = $ocr->run();
                    $ret['text'] = $text;
                    continue;
                }
                // Check if file has 'price' keyword in it
                if (substr_count($entry, 'price') > 0) {
                    $ocr->image($path)->lang('eng')->allowlist(range(0, 9), '.');
                    $price = $ocr->run();
                    $ret['price'] = $price;
                    continue;
                }

                // Check if file has 'desc' keyword in it
                if (substr_count($entry, 'desc') > 0) {
                    $ocr->image($path)->lang('eng');
                    $desc = $ocr->run();
                    $ret['price'] = $desc;
                    continue;
                } */

                $ocr->image($path)->lang('eng')->allowlist(range('A', 'Z'), range('a', 'z'), ' ', '\n');
                $text = $ocr->run();

                $ocr->image($path)->lang('eng')->allowlist(range(0, 9), '.');
                $num = $ocr->run();

                return ['text' => $text, 'price' => $num];

            }
        }

        return $ret;
    }
}
