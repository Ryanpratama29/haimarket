<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function cetakNota(){
    	$handle = printerOpen();
    	printer_start_doc($handle,"Nota");
    	printer_start_page($handle);

    	$font = printer_create_font("Arial",72,48,400,false,false,false,0);
    	printer_select_font($handle,$font);
    	printer_draw_text($handle,"STRUK BELANJA",400,100);
    	printer_delete_font($font);

    	printer_end_page($handle);
    	printer_end_doc($handle);
    	printer_close($handle);

    }
}
