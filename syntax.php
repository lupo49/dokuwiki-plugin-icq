<?php
/**
 * Plugin ICQ: Show if some ICQ user is online.
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Jakob Jensen <koeppe@kazur.dk>
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_icq extends DokuWiki_Syntax_Plugin {
 
    /**
     * return some info
     */
    function getInfo(){
        return array(
                'author' => 'Jakob Jensen',
                'email'  => 'koeppe@kazur.dk',
                'date'   => '2006-03-28',
                'name'   => 'ICQ plugin',
                'desc'   => 'Show if some ICQ user is online. Syntax: [[icq>0000000]]',
                'url'    => 'http://www.dokuwiki.org/plugin:icq',
                );
    }
 
    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'substition';
    }
 
    function getSort(){ return 298; }
 
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('\[\[icq>\w+\]\]',$mode,'plugin_icq');
    }
 
 
    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        $match = substr($match,6,-2);
        return array(strtolower($match));
    }
 
    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            $renderer->doc .= '<a href="http://wwp.icq.com/' . $data[0] . '">';
            $renderer->doc .= '<img border="0" alt="Online?" src="http://web.icq.com/whitepages/online?icq=' . $data[0] . '&amp;img=5" />';
            $renderer->doc .= '</a>';
            return true;
        }
        return false;
    }
}
?>