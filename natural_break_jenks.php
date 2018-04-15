<?php

function getJenksBreaks($datalist, $numclass){
    
    sort($datalist);
    
    $mat1=array();
    
    for($i=0; $i<=count($datalist); $i++){
        
        $temp=array();
        
        for($j=0; $j<=$numclass; $j++){
           array_push($temp, 0); 
        }
       array_push($mat1, $temp);  
        
    }
    
    $mat2=array();
    
    for($i=0; $i<=count($datalist); $i++){
    
    $temp=array();
        
         for($j=0; $j<=$numclass; $j++){
             
             array_push($temp, 0);
         }
        array_push($mat2, $temp);  
    
    }
    
    for($i=1; $i<=$numclass; $i++){
        
        $mat1[1][$i]=1;
        $mat2[1][$i]=0;
       
        for($j=2; $j<=count($datalist); $j++){
             $mat2[$j][$i]=INF;
        }
    }
$v=0.0;
    for($l=2; $l<=count($datalist); $l++){
        $s1=0.0;
        $s2=0.0;
        $w=0.0;
        for($m=1; $m<$l+1; $m++){
            $i3=$l-$m+1;
            $val=floatval($datalist[$i3-1]);
            $s2+=$val*$val;
            $s1+=$val;
            $w+=1;
            $v=$s2-($s1*$s1)/$w;
            $i4=$i3-1;
            
            if($i4 != 0){
                for($j=2; $j<=$numclass; $j++){
                    if($mat2[$l][$j] >=($v + $mat2[$i4][$j - 1])){
                        $mat1[$l][$j]=$i3;
                        $mat2[$l][$j]=$v+$mat2[$i4][$j-1];
                    }
                }
            }
        }
        $mat1[$l][1]=1;
        $mat2[$l][1]=$v;
    }
$k=count($datalist);   
$kclass=array();
    for($i=0; $i<=$numclass; $i++){
        array_push($kclass, 0);
        
    }
    
$kclass[$numclass]=floatval($datalist[count($datalist)-1]);
$countNum=$numclass;
    
    while($countNum>=2){
        $id=intval(($mat1[$k][$countNum])-2);
        $kclass[$countNum-1]=floatval($datalist[$id]);
        $k=intval(($mat1[$k][$countNum]-1));
        $countNum-=1;
    }
   return $kclass; 
}
?>