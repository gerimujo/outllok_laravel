<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\dhena;
use App\Models\hyrjeaktual;
use App\Models\hyrjedata;
use App\Models\biseda;
use App\Models\mesazhe;
use App\Models\mesazhehap;

class execute extends Controller
{
    function create(Request $request)
    {
        $random = rand(1, 1000);
        $rand = (String) $random;
        $dhen = new dhena();
        $dhen->id = $rand;
        $dhen->emri = $request->input('emri');
        $dhen->mbiemri = $request->input('mbiemri');
        $dhen->email = $request->input('email');
        $dhen->password = $request->input('password');
        $dhen->save();
        hyrjeaktual::truncate();
        $h = new hyrjeaktual();
        $h->id = $rand;
        $h->emri = $request->input('emri');
        $h->mbiemri = $request->input('mbiemri');
        $h->email = $request->input('email');
        $h->password = $request->input('password');
        $h->save();

        $hy = new hyrjedata();
        $hy->id = $rand;
        $hy->emri = $request->input('emri');
        $hy->mbiemri = $request->input('mbiemri');
        $hy->email = $request->input('email');
        $hy->password = $request->input('password');
        $hy->save();




        return ["proces" => "done"];




    }
    function merrhyrjemeail(Request $request)
    {
        $email = $request->input("email");

        $data = dhena::where("email", $email)->get();
        if (sizeof($data) > 0) {
            return ["proces" => "done", "email" => $data[0]['email'], "password" => $data[0]['password']];
        } else {
            return ["proces" => "notdone"];

        }



    }
    function hryjetamam(Request $request)
    {
        $email = $request->input("email");
        hyrjeaktual::truncate();
        $data = dhena::where("email", $email)->first();
        $h = new hyrjeaktual();
        $h->id = $data['id'];
        $h->emri = $data['emri'];
        $h->mbiemri = $data['mbiemri'];
        $h->email = $data['email'];
        $h->password = $data['password'];
        $h->save();

        $hy = new hyrjedata();
        $hy->id = $data['id'];
        $hy->emri = $data['emri'];
        $hy->mbiemri = $data['mbiemri'];
        $hy->email = $data['email'];
        $hy->password = $data['password'];
        $hy->save();

        return (["proces" => "done"]);



    }
    function marrhyrjedata()
    {
        $data = hyrjedata::all();
        $hyrje = hyrjeaktual::first();
        $emailun = $hyrje['email'];

        foreach ($data as $dat) {
            $emri = $dat['emri'];
            $shkr = substr($emri, 0, 1);
            $dat['sh'] = $shkr;
        }

        return (["data" => $data, "email" => $emailun]);
    }
    function hyrracc(Request $request)
    {
        $id = $request->input("id");
        $data = hyrjedata::where("id", $id)->get();
        hyrjeaktual::truncate();
        $h = new hyrjeaktual();
        $h->id = $data[0]['id'];
        $h->emri = $data[0]['emri'];
        $h->mbiemri = $data[0]['mbiemri'];
        $h->email = $data[0]['email'];
        $h->password = $data[0]['password'];
        $h->save();

        return (["proces" => "done"]);

    }
    function mesazheSendmarr()
    {
        $data = hyrjeaktual::first();
        $ngjyra = array("0077C0", "5EBB60", "E74C3C", "FFA500", "8E44AD", "F1C40F", "A9A9A9", "008080", "FFC0CB", "964B00");
        $rand = rand(0, 8);
        $data['sh'] = substr($data['emri'], 0, 1);
        $data['ngj'] = "#" . $ngjyra[$rand];
        return ($data);
    }
    function sendmesazh(Request $request)
    {
        $dataun = hyrjeaktual::first();
        $emailun = $dataun['email'];
        $emriun = $dataun['emri'];
        $emailai = $request->input("emailsend");
        $dataai = dhena::where("email", $emailai)->get();
        if (sizeof($dataai) > 0) {
            $emriai = $dataai[0]['emri'];
            $numri = rand(0, 1000);
            $bis = new biseda();
            $bis->emaild = $emailun;
            $bis->emrid = $emriun;
            $bis->subject = $request->input("subject");
            $bis->mesazhi = $request->input("mesazh");
            $bis->emailm = $emailai;
            $bis->emrim = $emriai;
            $bis->id = (string) $numri;
            $bis->save();
            $mes = new mesazhe();
            $mes->emaild = $emailun;
            $mes->emrid = $emriun;
            $mes->mesazhi = $request->input("mesazh");
            $mes->emailm = $emailai;
            $mes->emrim = $emriai;
            $mes->id = (string) $numri;
            $mes->save();

            return (["proces" => "done"]);
        } else {


            $emriai = "";
            $ind = strpos($emailai, "@");
            if ($ind !== false) {
                $emriai = substr($emailai, 0, $ind);

            }
            //  $emriai = $dataai[0]['emri'];
            $numri = rand(0, 1000);
            $bis = new biseda();
            $bis->emaild = $emailun;
            $bis->emrid = $emriun;
            $bis->subject = $request->input("subject");
            $bis->mesazhi = $request->input("mesazh");
            $bis->emailm = $emailai;
            $bis->emrim = $emriai;
            $bis->id = (string) $numri;
            $bis->save();
            $mes = new mesazhe();
            $mes->emaild = $emailun;
            $mes->emrid = $emriun;
            $mes->mesazhi = $request->input("mesazh");
            $mes->emailm = $emailai;
            $mes->emrim = $emriai;
            $mes->id = (string) $numri;
            $mes->save();

            return (["proces" => "done"]);


        }

    }
    function marrinbox()
    {
        $une = hyrjeaktual::first();
        $emailun = $une['email'];
        $emri = $une['emri'];
        $shkronjaun = substr($emri, 0, 1);
        $mesazhe = biseda::where("emailm", $emailun)->get();
        if (sizeof($mesazhe) > 0) {
            foreach ($mesazhe as $ms) {
                $ms['shkronja'] = substr($ms['emrid'], 0, 1);
            }
        }

        return (["mesazhe" => $mesazhe, "sh" => $shkronjaun]);

    }
    function hapmesazhe(Request $request)
    {
        $status = $request->input("status");
        if ($status == "inbox") {
            $mesazhet = mesazhe::where("id", $request->input("id"))->get();
            if (sizeof($mesazhet) > 0) {
                mesazhehap::truncate();
                foreach ($mesazhet as $msi) {
                    $ms = new mesazhehap();
                    $ms->emaild = $msi['emaild'];
                    $ms->emrid = $msi['emrid'];
                    $ms->mesazhi = $msi['mesazhi'];
                    $ms->emailm = $msi['emailm'];
                    $ms->emrim = $msi['emrim'];
                    $ms->id = $msi['id'];
                    $ms->status = "inbox";
                    $ms->save();
                }
            }

            return (["proces" => "done"]);
        } else if ($status == "sent") {
            $mesazhet = mesazhe::where("id", $request->input("id"))->get();
            if (sizeof($mesazhet) > 0) {
                mesazhehap::truncate();
                foreach ($mesazhet as $msi) {
                    $ms = new mesazhehap();
                    $ms->emaild = $msi['emaild'];
                    $ms->emrid = $msi['emrid'];
                    $ms->mesazhi = $msi['mesazhi'];
                    $ms->emailm = $msi['emailm'];
                    $ms->emrim = $msi['emrim'];
                    $ms->id = $msi['id'];
                    $ms->status = "sent";
                    $ms->save();
                }
            }

            return (["proces" => "done"]);

        }

    }
    function marrmesazhehap()
    {
        //do marrim subjektin
        $mesazhet = mesazhehap::all();
        $id = $mesazhet[0]['id'];
        $status = $mesazhet[0]['status'];
        if ($status == "inbox") {
            $bis1 = biseda::where("id", $id)->first();
            $emailun = $bis1['emailm'];
            $emrim = $bis1['emrim'];
            $emailai = $bis1['emaild'];
            $emriai = $bis1['emrid'];
            $id = $bis1['id'];
        } else if ($status == "sent") {
            $bis1 = biseda::where("id", $id)->first();
            $emailun = $bis1['emaild'];
            $emrim = $bis1['emrid'];
            $emailai = $bis1['emailm'];
            $emriai = $bis1['emrim'];
            $id = $bis1['id'];

        }




        $subjekti = $bis1['subject'];
        foreach ($mesazhet as $m) {
            $m['shkronja'] = substr($m['emrid'], 0, 1);
        }

        return (["subjekti" => $subjekti, "mesazhet" => $mesazhet, "emailun" => $emailun, "emriun" => $emrim, "emailai" => $emailai, "emriai" => $emriai, "id" => $id, "status" => $status]);
    }
    function sendReply(Request $request)
    {
        $text = $request->input("text");

        /*   data.append("text",relpys);
        data.append("emailun",emailun);
        data.append("emriun",emriun);
        data.append("emailai",emailai);
        data.append("emriai",emriai);
        data.append("kodi",kodi);*/

        $mes = new mesazhe();
        $mes->emaild = $request->input("emailun");
        $mes->emrid = $request->input("emriun");
        $mes->mesazhi = $request->input("text");
        $mes->emailm = $request->input("emailai");
        $mes->emrim = $request->input("emriai");
        $mes->id = $request->input("kodi");
        $mes->save();

        return (["proces" => "done"]);



    }
    function marrsentlist()
    {
        $un = hyrjeaktual::first();
        $emri = $un['emri'];
        $shkronja = substr($emri, 0, 1);
        $mesazhe = biseda::where("emrid", $emri)->get();
        if (sizeof($mesazhe) > 0) {
            foreach ($mesazhe as $ms) {
                $ms['shkronja'] = substr($ms['emrim'], 0, 1);
            }
        }

        return (["mesazhi" => $mesazhe, "sh" => $shkronja]);





    }
    function marrmesazhehap1()
    {
        //do marrim subjektin
        $mesazhet = mesazhehap::all();
        $id = $mesazhet[0]['id'];
        $bis1 = biseda::where("id", $id)->first();
        $emailun = $bis1['emailm'];
        $emrim = $bis1['emrim'];
        $emailai = $bis1['emaild'];
        $emriai = $bis1['emrid'];
        $id = $bis1['id'];



        $subjekti = $bis1['subject'];
        foreach ($mesazhet as $m) {
            $m['shkronja'] = substr($m['emrim'], 0, 1);
        }

        return (["subjekti" => $subjekti, "mesazhet" => $mesazhet, "emailun" => $emailun, "emriun" => $emrim, "emailai" => $emailai, "emriai" => $emriai, "id" => $id, "status" => "sent"]);
    }


}