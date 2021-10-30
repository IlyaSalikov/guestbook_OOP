<?php
    class Page
    {
        private $action;
        private $method;
        private $content;

        function __construct($a, $m, $elem1, $elem2='', $elem3='')
        {
            $this->action = $a;
            $this->method = $m;
            $this->content =
                $elem1->getFormElement().
                ($elem2 ? $elem2->getFormElement() : '').
                ($elem3 ? $elem3->getFormElement() : '');
        }

        function showForm()
        {
            echo '
            <form action='.$this->action.' method='.$this->method.'>'.
                $this->content.'
            </form>';
        }
    }

    class inputString
    {
        private $id;
        private $type;
        private $text;

        function __construct($id_name, $t, $tp)
        {
            $this->type = $tp;
            $this->id = $id_name;
            $this->text = $t;
        }
        function getInputString()
        {
            return
                '<label for='.$this->id.'>'.$this->text.' </label>
                <input id='.$this->id.' type='.$this->type.' name='.$this->id.'>';
        }
    }

    class Button
    {
        private $type;
        private $name;
        private $text;
        private $hide = '';
        private $link;

        function __construct($tp, $t, $n='', $h='', $link='')
        {
            $this->type = $tp;
            $this->name = $n;
            $this->text = $t;
            $this->link = $link;
            if ($h) $this->hide = 'disabled';
        }

        function getButton()
        {
            if ($this->type == 'a')
            {
                return '<a class="likeBtn" href='.$this->link.' '.$this->hide.'>'.$this->text.'</a>';
            }
            else
            {
                return '<button type="'.$this->type.'" name="'.$this->name.'" '.$this->hide.'>'.$this->text.'</button>';
            }
        }
    }


    class FormElement
    {
        function getFormElement();
    }

    class FormHeader extends FormElement
    {
        private $text;
        function __construct($t)
        {
            $this->text = $t;
        }
        function getFormElement()
        {
            return '<header><h1>'.$this->text.'</h1></header>';
        }
    }

    class FormSection extends FormElement
    {
        private $content;
        function __construct($c)
        {
            $this->content = $c;
        }
        function getFormElement()
        {
            return '<section>'.$this->content.'</section>';
        }
    }

    class FormFooter extends FormElement
    {
        private $btn1;
        private $btn2;
        private $btn3;

        function __construct($b1, $b2='', $b3='')
        {
            $this->btn1 = $b1;
            $this->btn2 = $b2;
            $this->btn3 = $b3;
        }

        function getFormElement()
        {
            return '<footer>'.
                        $this->btn1->getButton().
                        (($this->btn2) ? '<br>'.$this->btn2->getButton() : "").
                        (($this->btn3) ? '<br>'.$this->btn3->getButton() : "").
                    '</footer>';
        }
    }


    class Message
    {
        private $date;
        private $user;
        private $text;
        public static $count;

        function __construct($d, $u, $t)
        {
            $this->date = $d;
            $this->user = $u;
            $this->text = $t;
            self::$count++;
        }

        function getDate()
        {
            return $this->date;
        }
        function getUser()
        {
            return $this->user;
        }
        function getText()
        {
            return $this->text;
        }
        function getTableRow()
        {
            return "<tr>
                        <td>".$this->date."</td>
                        <td>".$this->user."</td>
                        <td>".$this->text."</td>
                    </tr>";
        }
    }

    class Table
    {
        public $array = array();
        private $content;
        public $count;

        function __construct($h_list)
        {
            $this->content = "<table> <tr>";
            foreach ($h_list as $h)
            {
                $this->content .= "<th>".$h."</th>";
            }
        }

        function showTable()
        {
            foreach ($this->array as $row)
            {
                $this->content .= $row->getTableRow();
            }
            $this->content .= "</table>";
            echo $this->content;
        }

        function addToTable($message)
        {
            array_push($this->array, $message);
            self::$count++;
        }
    }