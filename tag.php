<?php

interface ITagEx
{
	public function SetComment($tag, $comm = null);
	public function SetItem($tag, $Item);
	public function SetUnmanagedItem($tag, $Item);
	public function AddItem($tag, $Item);
	public function AddUnmanagedItem($tag, $Item);
	public function AddAtribute($tag, $AttributeName, $AttributeValue);
	public function RenderAttributes($tag);
	public function Render($tag);
}

class dtag
{
	public static function ValidItem($Item)
	{
		if ($Item instanceof head)
		{
			throw new Exception ( "Warning: Obsolete method, don't use AddItem with an instance of <b>head</b>. Use html->setHead() instead." );
		}
		if ($Item instanceof body)
		{
			throw new Exception ( "Warning: Obsolete method, don't use AddItem with an instance of <b>body</b>. Use html->setBody() instead." );
		}
		if ($Item instanceof title)
		{
			throw new Exception ( "Warning: Obsolete method, don't use AddItem with an instance of <b>title</b>. Use head->setTitle() instead." );
		}
		
		return (TRUE);
	}
	
	public static function ExistItem($tag, $Item)
	{
		$found = FALSE;
		
		if (isset ( $tag->Items ))
		{
			foreach ( $tag->Items as $value )
			{
				if ($value->Name == $Item->Name)
				{
					throw new Exception ( "Error: There already exist an item of <b>$Item->Name</b> type added to <b>$tag->Name</b> tag." );
				}
			}
		}
		
		return ($found);
	}
	
	public static function SetComment($tag, $comm = null)
	{
		$tag->comment = TRUE;
		$tag->txtComment = $comm;
	}
	
	public static function SetItem($tag, $Item)
	{
		if (dtag::ValidItem ( $Item ) && ! dtag::ExistItem ( $tag, $Item ))
		{
			$tag->AddUnmanagedItem ( $Item );
		}
	}
	
	public static function SetUnmanagedItem($tag, $Item)
	{
		if (! dtag::ExistItem ( $tag, $Item ))
		{
			$tag->AddUnmanagedItem ( $Item );
		}
	}
	
	public static function AddItem($tag, $Item)
	{
		if (dtag::ValidItem ( $Item ))
		{
			$tag->AddUnmanagedItem ( $Item );
		}
	}
	
	public static function AddUnmanagedItem($tag, $Item)
	{
		if (! isset ( $tag->Items ))
		{
			$tag->Items = array ( );
		}
		
		array_push ( $tag->Items, $Item );
	}
	
	public static function AddAtribute($tag, $AttributeName, $AttributeValue)
	{
		if (! isset ( $tag->Attributes ))
		{
			$tag->Attributes = array ( );
		}
		$Attribute = array ( );
		$Attribute ["name"] = $AttributeName;
		$Attribute ["value"] = $AttributeValue;
		array_push ( $tag->Attributes, $Attribute );
	}
	
	public static function RenderAttributes($tag)
	{
		$code = "";
		if (isset ( $tag->Attributes ))
		{
			foreach ( $tag->Attributes as $attr )
			{
				$code .= $attr ["name"] . "=\"" . $attr ["value"] . "\" ";
			}
		}
		if ($code != "")
		{
			return " " . trim ( $code );
		} else
		{
			return "";
		}
	}
	
	public static function Render($tag)
	{
		
		if ($tag->comment)
		{
			if ($tag->txtComment == null)
			{
				$code = "<!-- Begin " . $tag->Name . " -->\n";
			} else
			{
				$code = "<!-- Begin " . $tag->txtComment . " -->\n";
			}
		} else
		{
			$code = "";
		}
		
		if (count ( $tag->Items ) > 0 || ! in_array ( $tag->Name, tag::$singletags ))
		{
			$code_begin = "<" . $tag->Name . $tag->RenderAttributes () . ">";
			$code_body = "";
			if (count ( $tag->Items ) > 0)
			{
				foreach ( $tag->Items as $itm )
				{
					if ($itm instanceof tag)
					{
						$code_body .= $itm->Render ();
					} else
					{
						$code_body .= $itm;
					}
				}
				if (count ( $tag->Items ) != 1 || (count ( $tag->Items ) == 1 && $tag->Items [0] instanceof tag))
				{
					$code_body = $code_body . "\n";
					$code_body = preg_replace ( '/^/m', "\t", $code_body );
				}
			}
			$code_end = "</" . $tag->Name . ">";
			
			$code .= "\n" . $code_begin . $code_body . $code_end;
		
		} else
		{
			$code .= "\n" . "<" . $tag->Name . " " . $tag->RenderAttributes () . " />";
		}
		if ($tag->comment)
		{
			if ($tag->txtComment == null)
			{
				$code .= "<!-- End " . $tag->Name . " -->\n";
			} else
			{
				$code .= "<!-- End " . $tag->txtComment . " -->\n";
			}
		}
		
		return $code;
	}
}

class rtag
{
	public static function SetComment($tag, $comm = null)
	{
		$tag->comment = TRUE;
		$tag->txtComment = $comm;
	}
	
	public static function SetItem($tag, $Item)
	{
		$tag->AddUnmanagedItem ( $Item );
	}
	
	public static function SetUnmanagedItem($tag, $Item)
	{
		$tag->AddUnmanagedItem ( $Item );
	}
	
	public static function AddItem($tag, $Item)
	{
		$tag->AddUnmanagedItem ( $Item );
	}
	
	public static function AddUnmanagedItem($tag, $Item)
	{
		if (! isset ( $tag->Items ))
		{
			$tag->Items = array ( );
		}
		
		array_push ( $tag->Items, $Item );
	}
	
	public static function AddAtribute($tag, $AttributeName, $AttributeValue)
	{
		if (! isset ( $tag->Attributes ))
		{
			$tag->Attributes = array ( );
		}
		$Attribute = array ( );
		$Attribute ["name"] = $AttributeName;
		$Attribute ["value"] = $AttributeValue;
		array_push ( $tag->Attributes, $Attribute );
	}
	
	public static function RenderAttributes($tag)
	{
		$code = "";
		if (isset ( $tag->Attributes ))
		{
			foreach ( $tag->Attributes as $attr )
			{
				$code .= $attr ["name"] . "=\"" . $attr ["value"] . "\" ";
			}
		}
		if ($code != "")
		{
			return " " . trim ( $code );
		} else
		{
			return "";
		}
	}
	
	public static function Render($tag)
	{
		if ($tag->comment)
		{
			if ($tag->txtComment == null)
			{
				$code = "<!-- Begin " . $tag->Name . " -->\n";
			} else
			{
				$code = "<!-- Begin " . $tag->txtComment . " -->\n";
			}
		} else
		{
			$code = "";
		}
		
		if (count ( $tag->Items ) > 0 || ! in_array ( $tag->Name, tag::$singletags ))
		{
			$code_begin = "<" . $tag->Name . $tag->RenderAttributes () . ">";
			$code_body = "";
			if (count ( $tag->Items ) > 0)
			{
				foreach ( $tag->Items as $itm )
				{
					if ($itm instanceof tag)
					{
						$code_body .= $itm->Render ();
					} else
					{
						$code_body .= $itm;
					}
				}
				if (count ( $tag->Items ) != 1 || (count ( $tag->Items ) == 1 && $tag->Items [0] instanceof tag))
				{
					$code_body = $code_body . "\n";
				}
			}
			$code_end = "</" . $tag->Name . ">";
			
			$code .= "\n" . $code_begin . $code_body . $code_end;
		
		} else
		{
			$code .= "\n" . "<" . $tag->Name . " " . $tag->RenderAttributes () . " />";
		}
		if ($tag->comment)
		{
			if ($tag->txtComment == null)
			{
				$code .= "<!-- End " . $tag->Name . " -->\n";
			} else
			{
				$code .= "<!-- End " . $tag->txtComment . " -->\n";
			}
		}
		
		return $code;
	}
}

interface ITag
{
	public function SetComment($comm = null);
	public function SetItem($Item);
	public function SetUnmanagedItem($Item);
	public function AddItem($Item);
	public function AddUnmanagedItem($Item);
	public function AddAtribute($AttributeName, $AttributeValue);
	public function RenderAttributes();
	public function Render();
}

class tag implements ITag
{
	public static $singletags = array (
										"br", 
										"img", 
										"input", 
										"link", 
										"meta", 
										"hr" );
	
	public $Name;
	public $Items;
	public $Attributes;
	public $comment;
	private $txtComment;
	
	public static $mtag;
	
	function __construct($name)
	{
		$this->Name = $name;
	}
	
	public function SetComment($comm = null)
	{
		return tag::$mtag->SetComment ( $this, $comm );
	}
	
	public function SetItem($Item)
	{
		return tag::$mtag->SetItem ( $this, $Item );
	}
	
	public function SetUnmanagedItem($Item)
	{
		return tag::$mtag->SetUnmanagedItem ( $this, $Item );
	}
	
	public function AddItem($Item)
	{
		return tag::$mtag->AddItem ( $this, $Item );
	}
	
	public function AddUnmanagedItem($Item)
	{
		return tag::$mtag->AddUnmanagedItem ( $this, $Item );
	}
	
	public function AddAtribute($AttributeName, $AttributeValue)
	{
		return tag::$mtag->AddAtribute ( $this, $AttributeName, $AttributeValue );
	}
	
	public function RenderAttributes()
	{
		return tag::$mtag->RenderAttributes ( $this );
	}
	
	public function Render()
	{
		return tag::$mtag->Render ( $this );
	}
}

?>