<?php
require_once 'tag.php';

class vtag extends tag
{
	public function setClass($className)
	{
		$this->AddAtribute ( "class", $className );
	}
	
	public function setId($idName)
	{
		$this->AddAtribute ( "id", $idName );
	}
}

class ftag extends tag
{

}

class comment extends tag
{
	function render()
	{
		$start = "\n<!--";
		$end = "-->\n";
		$code_body = "";
		if (count ( $this->Items ) > 0)
		{
			foreach ( $this->Items as $itm )
			{
				if ($itm instanceof tag)
				{
					$code_body .= $itm->Render ();
				} else
				{
					$code_body .= $itm;
				}
			}
		}
		return $start . $code_body . $end;
	}
}

?>