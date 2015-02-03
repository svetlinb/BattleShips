<?php
/*
* Generate web page.
* Wrapper for generated data from WebView class.
*
*/
class HtmlDecorator {
	
/*
* Generate web page.
*
* @return void
* @access public
*/
public function render(){
echo <<<EOD
<!DOCTYPE html>
  <html>
   <head>
    <title>BattleShips Programming Test</title>
     <style>
	     .button {
		  font: bold 11px Arial;
		  text-decoration: none;
		  background-color: #EEEEEE;
		  color: #333333;
		  padding: 2px 6px 2px 6px;
		  border-top: 1px solid #CCCCCC;
		  border-right: 1px solid #333333;
		  border-bottom: 1px solid #333333;
		  border-left: 1px solid #CCCCCC;
		}
     </style>
   </head>
   <body>
   <a href="/?battle-newGame" class="button">Start New Game</a>  <a href="/?battle-cheat" class="button">Cheat</a> 
   <br />
    {$this->grid}
   <br />
   <form action="/?battle-play" method="post">
   <input name="xy" type="text"/>	
   <input type="submit" value="Hit"/>
   </form>
  </body>
</html>
EOD;
	
}

}

?>