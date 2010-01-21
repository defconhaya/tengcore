<?php

/*
 * Functional Tags
 */

require_once 'tags.php';
require_once 'const.php';

class html extends ftag
{
	private $doctype;
	
	function __construct($doctype)
	{
		parent::__construct ( "html" );
		$this->doctype = $doctype;
	}
	
	function Render()
	{
		$encoding = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\n";
		return $encoding . $this->doctype . parent::Render ();
	}
	
	function SetHead($head)
	{
		$this->SetUnmanagedItem ( $head );
	}
	
	function SetBody($body)
	{
		$this->SetUnmanagedItem ( $body );
	}

}

class link extends ftag
{
	function __construct()
	{
		parent::__construct ( "link" );
	
	}
	
	function setRel($rel)
	{
		$this->AddAtribute ( "rel", $rel );
	}
	
	function setType($type)
	{
		$this->AddAtribute ( "type", $type );
	}
	
	function setTitle($title)
	{
		$this->AddAtribute ( "title", $title );
	}
	
	function setHref($href)
	{
		$this->AddAtribute ( "href", $href );
	}
	
	function setMedia($media)
	{
		$this->AddAtribute ( "media", $media );
	}
}

class script extends ftag
{
	function __construct($type, $src)
	{
		parent::__construct ( "script" );
		
		if ($type != null)
		{
			$this->AddAtribute ( "type", $type );
		}
		if ($src != null)
		{
			$this->AddAtribute ( "src", $src );
		}
	}
}

class form extends ftag
{
	function __construct()
	{
		parent::__construct ( "form" );
	
	}
}

class head extends ftag
{
	function __construct()
	{
		parent::__construct ( "head" );
		
		$this->AddMeta ( "generator", tengcore::$engine . " " . tengcore::$version );
	}
	
	function SetTitle($title)
	{
		$iTitle = new title ( $title );
		$this->SetUnmanagedItem ( $iTitle );
	}
	
	function AddRSS($feedtitle, $feed)
	{
		$rss = new link ( );
		$rss->setRel ( "alternate" );
		$rss->setType ( "application/rss+xml" );
		$rss->setTitle ( $feedtitle );
		$rss->setHref ( $feed );
		
		$this->AddItem ( $rss );
	}
	
	function AddCSS($cssFile)
	{
		$css = new link ( );
		$css->setRel ( "stylesheet" );
		$css->setType ( "text/css" );
		$css->setHref ( $cssFile );
		$css->setMedia ( "screen" );
		
		$this->AddItem ( $css );
	}
	
	function AddJsScript($jsFile)
	{
		$script = new script ( "text/javascript", $jsFile );
		$this->AddItem ( $script );
	}
	
	function setFavicon($icon)
	{
		$link = new link ( );
		$link->setRel ( "shortcut icon" );
		$link->setHref ( $icon );
		
		$this->AddItem ( $link );
	}
	
	function AddMeta($name, $content)
	{
		$meta = new meta ( );
		$meta->AddAtribute ( "name", $name );
		$meta->AddAtribute ( "content", $content );
		$this->AddItem ( $meta );
	}
	
	function AddMeta_httpequiv($httpequiv, $content)
	{
		$meta = new meta ( );
		$meta->AddAtribute ( "http-equiv", $httpequiv );
		$meta->AddAtribute ( "content", $content );
		$this->AddItem ( $meta );
	}
	
	function AddMetaKeywords($keyword_array)
	{
		$this->AddMeta ( "keywords", implode ( ", ", array_unique ( $keyword_array ) ) );
	}
}

class title extends ftag
{
	function __construct($title)
	{
		parent::__construct ( "title" );
		$this->SetItem ( $title );
	}
}

class meta extends ftag
{
	function __construct()
	{
		parent::__construct ( "meta" );
	}
}

class meta_httpequiv extends ftag
{
	function __construct()
	{
		parent::__construct ( "meta" );
	}
}

?>