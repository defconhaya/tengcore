<?php

/*
 * Visual Tags
 */

require_once 'tags.php';
require_once 'const.php';

class div extends vtag
{
	
	function __construct()
	{
		$this->Name = "div";
	}
	
	function setOnClick($action)
	{
		$this->AddAtribute ( "onClick", $action );
	}
}

class body extends vtag
{
	function __construct()
	{
		$this->Name = "body";
	}
}

class input extends vtag //TBD
{
	function __construct()
	{
		$this->Name = "input";
	}
}

class table extends vtag //TBD
{
	function __construct()
	{
		$this->Name = "table";
	}
}

class td extends vtag
{
	function __construct()
	{
		$this->Name = "td";
	}
}

class tr extends vtag
{
	function __construct()
	{
		$this->Name = "tr";
	}
}

class thead extends vtag
{
	function __construct()
	{
		$this->Name = "thead";
	}
}

class tbody extends vtag
{
	function __construct()
	{
		$this->Name = "tbody";
	}
}

class tfoot extends vtag
{
	function __construct()
	{
		$this->Name = "tfoot";
	}
}

class ul extends vtag
{
	function __construct()
	{
		$this->Name = "ul";
	}
	
	function addLi($li)
	{
		$this->AddItem ( $li );
	}
}

class ol extends vtag
{
	function __construct()
	{
		$this->Name = "ol";
	}
}

class li extends vtag
{
	function __construct()
	{
		$this->Name = "li";
	}
}

class span extends vtag
{
	function __construct()
	{
		$this->Name = "span";
	}
}

class hr extends vtag
{
	function __construct()
	{
		$this->Name = "hr";
	}
}

class a_href extends vtag
{
	function __construct()
	{
		$this->Name = "a";
	}
	
	public function setHref($href)
	{
		$this->AddAtribute ( "href", $href );
	}
	
	public function setTitle($title)
	{
		$this->AddAtribute ( "title", $title );
	}
}

class img extends vtag
{
	function __construct($src, $alt)
	{
		$this->Name = "img";
		$this->AddAtribute ( "src", $src );
		$this->AddAtribute ( "alt", $alt );
	}
}

class h1 extends vtag
{
	function __construct()
	{
		$this->Name = "h1";
	}
}

class h2 extends vtag
{
	function __construct()
	{
		$this->Name = "h2";
	}
}

class h3 extends vtag
{
	function __construct()
	{
		$this->Name = "h3";
	}
}

class h4 extends vtag
{
	function __construct()
	{
		$this->Name = "h4";
	}
}

class p extends vtag
{
	function __construct()
	{
		$this->Name = "p";
	}
}

class select extends vtag
{
	function __construct()
	{
		$this->Name = "select";
	}
}

class option extends vtag
{
	function __construct()
	{
		$this->Name = "option";
	}
}

class textarea extends vtag
{
	function __construct($cols, $rows)
	{
		$this->Name = "textarea";
		$this->AddAtribute ( "cols", $cols );
		$this->AddAtribute ( "rows", $rows );
	}
}

class label extends vtag
{
	function __construct($for, $caption)
	{
		$this->Name = "label";
		$this->AddAtribute ( "for", $for );
		$this->AddItem ( $caption );
	}
}

class strong extends vtag
{
	function __construct()
	{
		$this->Name = "strong";
	}
}

class fieldset extends vtag
{
	function __construct()
	{
		$this->Name = "fieldset";
	}
}

class br extends vtag
{
	function __construct()
	{
		$this->Name = "br";
	}
}

class legend extends vtag
{
	function __construct()
	{
		$this->Name = "legend";
	}
}
?>