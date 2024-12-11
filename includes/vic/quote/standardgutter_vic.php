<?php
$heading = isset($gutter[0]) ? $gutter[0] : null;
$BeamIDArrayPhp .= isset($gutter[1]) ? 'BeamIDArray["'.$heading.'"]="'.$gutter[1].'";' : null;	
$BeamDESCArrayPhp .= isset($gutter[2]) ? 'BeamDESCArray["'.$heading.'"]="'.$gutter[2].'";' : null;
$BeamRRPArrayPhp .= isset($gutter[4]) ? 'BeamRRPArray["'.$heading.'"]="'.$gutter[4].'";' : null;
$BeamCOSTArrayPhp .= isset($gutter[5]) ? 'BeamCOSTArray["'.$heading.'"]="'.$gutter[5].'";' : null;
?>