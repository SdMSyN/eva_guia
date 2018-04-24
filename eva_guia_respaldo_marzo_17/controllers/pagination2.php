<?php


function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul class="pagination pagination-large">';
	
        // first label
	if($page>($adjacents+1)) {
		$out.= "<li><a>1</a></li>";
	}
        
	// interval
	if($page>($adjacents+2)) {
		$out.= "<li><a>...</a></li>";
	}

        // pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li class='active' class='autoSave'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li  class='disabled'><a>$i</a></li>";
		}else {
			$out.= "<li class='disabled'><a>$i</a></li>";
		}
	}
        
	// interval
	if($page<($tpages-$adjacents-1)) {
		$out.= "<li><a>...</a></li>";
	}

        // last
	if($page<($tpages-$adjacents)) {
		$out.= "<li class='disabled'><a>$tpages</a></li>";
	}
        
	// next
	if($page<$tpages) {
		$out.= "<li><span><a href='javascript:void(0);' onclick='autoSave(); load(".($page+1).")' >$nextlabel</a></span></li>";
	}else {
		$out.= "<li ><span id='evaluate2'><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}
?>