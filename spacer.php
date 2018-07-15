<?php

class Spacer
{
    private $JOINER = "‍";
    private $NONJOINER = "‌";
    private $SPACE = "​";
    private $NOBREAK_SPACE = "⁠";

    protected function toBinary($txt) 
    {
        // Convert's string to binary
        $binary = unpack('H*', $txt);
        return base_convert($binary[1], 16, 2);
    }
    
    protected function toString($binary)
    {
        // Convert binary into a string
        return pack('H*', base_convert($binary, 2, 16));
    }

    function space($secret, $msg = null) {
        $binary = $this->toBinary($secret);
        $final = "";

        //  Iterarte over the binary.
        for ($i = 0; $i < strlen($binary); $i++) {
            if ($binary[$i] == "1") {
                $final .= $this->JOINER;
            } elseif ($binary[$i] == "0") {
                $final .= $this->NONJOINER;
            } elseif ($binary[$i] == " ") {
                $final .= $this->SPACE;
            }
        }

        if (empty($msg)) {
            return $final;
        } else {
            $index = rand(0, strlen($msg));
            return substr($msg, 0, $index) . $final . substr($msg, $index);
        }
    }

    function unspace($msg) {
        $binary = "";

        //  thx to https://github.com/mikkel1156/ZeroWidth-Coder-PHP
        preg_match_all("/(‍|‌|​|⁠)/", $msg, $match);

        //  Iterarte over the matches.
        for ($i = 0; $i < count($match[0]); $i++) {
            if ($match[0][$i] == $this->JOINER) {
                $binary .= "1";
            } elseif ($match[0][$i] == $this->NONJOINER) {
                $binary .= "0";
            } elseif ($match[0][$i] == $this->SPACE) {
                $binary .= " ";
            }
        }

        return $this->toString($binary);
    }
}
?>
