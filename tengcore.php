<?php
require_once 'const.php';
require_once 'vtags.php';
require_once 'ftags.php';

class tengcore
{
	public static $version = "0.2";
	public static $engine = "tengcore";
	public static $mode = 0; // 0 - DEBUG; 1 - RELEASE;	
	

	private $html;
	private $head;
	private $body;
	
	private $container;
	
	private $buildmode = 0;
	
	function __construct($buildmode)
	{
		//		if ($mode == 0)
		//		{
		tag::$mtag = new dtag ( );
		//		}
		//		if ($mode == 1)
		//		{
		//			tag::$mtag = new rtag ( );
		//		}
		$this->buildmode = $buildmode;
		
		if ($buildmode != tengcoremodes::$unmanaged)
		{
			switch ( $buildmode)
			{
				case tengcoremodes::$managed_html_frameset :
					$this->html = new html ( doctype::$html_frameset );
				break;
				case tengcoremodes::$managed_html_loose :
					$this->html = new html ( doctype::$html_loose );
				break;
				case tengcoremodes::$managed_html_strict :
					$this->html = new html ( doctype::$html_strict );
				break;
				case tengcoremodes::$managed_xhtml_frameset :
					$this->html = new html ( doctype::$xhtml_frameset );
				break;
				case tengcoremodes::$managed_xhtml_loose :
					$this->html = new html ( doctype::$xhtml_loose );
				break;
				case tengcoremodes::$managed_xhtml_strict :
					$this->html = new html ( doctype::$xhtml_strict );
				break;
			}
			
			$this->head = new head ( );
			$this->body = new body ( );
			
			$this->html->SetHead ( $this->head );
			$this->html->SetBody ( $this->body );
		} else
		{
			$this->container = array ( );
		}
	}
	
	function AddElement($element)
	{
		if ($this->buildmode == tengcoremodes::$unmanaged)
		{
			$this->container [] = $element;
		} else
		{
			if ($element instanceof body || $element instanceof head || $element instanceof html)
			{
				throw new Exception ( "Cannot add " . get_class ( $element ) . " in unmanaged mode !" );
			} else
			{
				switch ( get_class ( $element ))
				{
					case 'title' :
						throw new Exception ( "Use SetTitle method !" );
					break;
					default :
						$this->body->AddItem ( $element );
					break;
				}
			}
		}
	}
	
	function AddCSS($cssfile)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->AddCSS ( $cssfile );
		} else
		{
			throw new Exception ( "Cannot add css in unmanaged mode !" );
		}
	}
	
	function setClass($class)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->body->setClass ( $class );
		} else
		{
			throw new Exception ( "Cannot add css in unmanaged mode !" );
		}
	}
	
	function SetTitle($title)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->SetTitle ( $title );
		} else
		{
			throw new Exception ( "Cannot set title in unmanaged mode !" );
		}
	}
	
	function AddJsScript($jsFile)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->AddJsScript ( $jsFile );
		} else
		{
			throw new Exception ( "Cannot add scripts in unmanaged mode !" );
		}
	}
	
	function AddRSS($feedtitle, $feed)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->AddRSS ( $feedtitle, $feed );
		} else
		{
			throw new Exception ( "Cannot add RSS in unmanaged mode !" );
		}
	}
	
	function setFavicon($icon)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->setFavicon ( $icon );
		} else
		{
			throw new Exception ( "Cannot set favicon in unmanaged mode !" );
		}
	}
	
	function AddMeta($name, $content)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->AddMeta ( $name, $content );
		} else
		{
			throw new Exception ( "Cannot add meta in unmanaged mode !" );
		}
	}
	
	function AddMeta_httpequiv($httpequiv, $content)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->AddMeta_httpequiv ( $httpequiv, $content );
		} else
		{
			throw new Exception ( "Cannot add meta in unmanaged mode !" );
		}
	}
	
	function AddMetaKeywords($keyword_array)
	{
		if ($this->buildmode != tengcoremodes::$unmanaged)
		{
			$this->head->AddMetaKeywords ( $keyword_array );
		} else
		{
			throw new Exception ( "Cannot add keywords in unmanaged mode !" );
		}
	}
	
	function Render()
	{
		if ($this->buildmode == tengcoremodes::$unmanaged)
		{
			foreach ( $this->container as $itm )
			{
				if (is_a ( $itm, tag ))
				{
					echo $itm->Render ();
				} else
				{
					echo $itm;
				}
			}
		} else
		{
			echo $this->html->Render ();
		}
	
	}
}
?>