<?php
    if (!empty($_POST)) {
        if (!isset($_POST['rewrite'])) {
            $str = '';
            if (file_exists($file_name)) {
                $file = file($file_name);
                for($i = 0; $i < count($file); $i++) {
                    $id = explode(' ', $file[$i])[1];
                    if (array_key_exists($id, $_POST)) {
                        if (!empty($_POST[$id]['count']) && !empty($_POST[$id]['check'])) {
                            $file[$i] = 'player.additem ' . $id . ' ' . $_POST[$id]['count'] . PHP_EOL;
                            unset($_POST[$id]);
                        }
                    }
                }
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        if (array_key_exists('check', $value) && !empty($value['count'])) {
                            $str .= 'player.additem ' . $key . ' ' . $value['count'] . PHP_EOL;
                            
                        }
                    }
                }
                file_put_contents($file_name, $file);
                file_put_contents($file_name, $str, FILE_APPEND);
            } else {
                foreach ($_POST as $key => $value) {
                    if (is_array($value)) {
                        if (array_key_exists('check', $value) && !empty($value['count'])) {
                            $str .= 'player.additem ' . $key . ' ' . $value['count'] . PHP_EOL;
                            
                        }
                    }
                }
                file_put_contents($file_name, $str, FILE_APPEND);
            }
        } else {
            $str = '';
            foreach ($_POST as $key => $value) {
                if (is_array($value)) {
                    if (array_key_exists('check', $value) && !empty($value['count'])) {
                        $str .= 'player.additem ' . $key . ' ' . $value['count'] . PHP_EOL;
                        
                    }
                }
            }
            file_put_contents($file_name, $str);
        }
    }
?>