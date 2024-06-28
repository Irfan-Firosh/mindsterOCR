<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use thiagoalessio\TesseractOCR\TesseractOCR as TesseractOCRTesseractOCR;

// classification stuff
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;

class testController extends Controller
{
    // Handles File Uploads
    public function upload(Request $request) {
        $request->validate([
            'file' => 'required|mimes:jpg,png|max:2048',
            'type' => 'required',
        ]);

        $file = $request->file('file');
        $type = $request->input('type');

        $customName = $type . "_" . $file->getClientOriginalName();

        $path = $file->storeAs('uploads', $customName, 'public');

        return "File Uploaded At: " . $path;
    }

    public function crop() {
        $im = imagecreatefrompng( "/Applications/XAMPP/xamppfiles/htdocs/ocr/public/imgs/price0.png");
        $size = min(imagesx($im), imagesy($im));

        $im2 = imagecrop($im, ['x' => 635, 'y' => 569, 'width' => $size/2, 'height' => $size/4]); 
        if ($im2 !== FALSE) {  
            imagepng($im2, 'cropped/example.png'); 
            imagedestroy($im2); 
        } 
        imagedestroy($im);
    }

    public function index() {
        $dir = '/Applications/XAMPP/xamppfiles/htdocs/ocr/storage/app/public/uploads';
        $entries = scandir($dir);
        $ocr = new TesseractOCRTesseractOCR();
        $ret = ['title' => 'Nothing Seleted', 'price' => 'Nothing Selected', 'desc' => 'Nothing Selected'];
        $text = null;
        foreach ($entries as $entry) {
            if ($entry != '..' && $entry != '.') {
                $path = $dir . '/' . $entry;
                // Check if file has 'title' keyword in it
                if (substr_count($entry, 'title') > 0) {
                    try {
                        $ocr->image($path)->lang('eng')->allowlist(range('A', 'Z'), range('a', 'z'), ' ', '\n');
                        $text = $ocr->run();
                        $ret['title'] = $text;
                    } catch (Exception $e) {
                        $ret['title'] = "Failed to scan";
                    }
                    continue;
                }
                // Check if file has 'price' keyword in it
                if (substr_count($entry, 'price') > 0) {
                    try {
                        $ocr->image($path)->lang('eng')->allowlist(range(0, 9), '.');
                        $price = $ocr->run();
                        $ret['price'] = $price;
                    } catch (Exception $e) {
                        $ret['price'] = "Failed to scan";
                    }
                    continue;
                }

                // Check if file has 'desc' keyword in it
                if (substr_count($entry, 'desc') > 0) {
                    try {
                        $ocr->image($path)->lang('eng');
                        $desc = $ocr->run();
                        $ret['desc'] = $desc;
                    } catch (Exception $e) {
                        $ret['desc'] = "Failed to scan";
                    }
                    continue;
                }
            }      
        }
        return view('info', $ret);
    }
}
