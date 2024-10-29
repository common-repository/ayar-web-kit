<?php // Report all PHP errors (see changelog)
//error_reporting(E_ALL);
?>
<?php

class CONVERTER {
	
	private $logfile="wp-content/ayar_rss_log.txt";
	private $fh;
	private $BeginTime;
	private $EndTime;
	
	//unicode number to character
	private function unichr($hex)
	{
		$str="&#".hexdec($hex).";";
		return html_entity_decode($str, ENT_QUOTES, "UTF-8");
	}
	function ayar_zg($txt)
	{
		$tallAA=$this->unichr("102B");#-ါ
		$AA=$this->unichr("102C");#-ာ
		$vi=$this->unichr("102D");#- ိ
		
		//lone gyi tin
		$ii=$this->unichr("102E");# -ီ ေဇာ္ဂ်ီ၊  ယူနီကုဒ္ တူ
		$u=$this->unichr("102F");# -ု တစ္ေခ်ာင္းငင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$uu=$this->unichr("1030");# -ူ နွစ္ေခ်ာင္းငင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$ve=$this->unichr("1031");# ေ သေဝထိုး ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		
		$ai = $this->unichr("1032");#  ဲ ေနာက္ထိုးပစ္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$ans = $this->unichr("1036");# -ံ ေသးေသးတင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ 
		$db = $this->unichr("1037");# -့ ေအာက္ကျမင့္ ေဇာ္ဂ်ီ ယူနီကုဒ္ တူ ေဇာ္ဂ်ီမွာ သံုးမ်ိုး u1094 u1095
		$visarga = $this->unichr("1038");# -း ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
	
		$asat = $this->unichr("1039");#
	
		$ya = $this->unichr("103A");# 
		$ra = $this->unichr("103B");# 
		$wa = $this->unichr("103C");# 
		$ha = $this->unichr("103D");# 
		$uha = $this->unichr("103E");
		$zero = $this->unichr("1040");# သုည ဂဏန္း
		$shr = $this->unichr("102F").$this->unichr("1030").$this->unichr("1037").$this->unichr("103D").$this->unichr("103E").$this->unichr("1087").$this->unichr("1088").$this->unichr("1089");
		$up = $this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036").$this->unichr("1039").$this->unichr("1064").$this->unichr("108C").$this->unichr("108D").$this->unichr("108E");
		$raW = $this->unichr("1000").$this->unichr("1003").$this->unichr("100F").$this->unichr("1010").$this->unichr("1011").$this->unichr("1018").$this->unichr("101A").$this->unichr("101C").$this->unichr("101E").$this->unichr("101F").$this->unichr("1021");
		//$cons = $this->unichr("1000")-$this->unichr("1021");
		$raN = $this->unichr("1001").$this->unichr("1002").$this->unichr("1004").$this->unichr("1005").$this->unichr("1007").$this->unichr("100E").$this->unichr("1012").$this->unichr("1013").$this->unichr("1015").$this->unichr("1016").$this->unichr("1017").$this->unichr("1019").$this->unichr("101D").$this->unichr("1021");
		$zglower = $this->unichr("1060")."-".$this->unichr("1063").$this->unichr("1065")."-".$this->unichr("1069").$this->unichr("106C").$this->unichr("106D").$this->unichr("1070")."-".$this->unichr("107C").$this->unichr("1093").$this->unichr("1096");
		
		$j=0;
		
		$pattern[$j]="/".$this->unichr("1009")."(?=[".$shr."])/u";# 
		$replacement[$j] = $this->unichr("106A");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1009")."(?=[".$this->unichr("103A").$this->unichr("102C")."])/u";# 
		$replacement[$j] = $this->unichr("1025");#
	
		$j++;
	
		$pattern[$j]="/".$this->unichr("1025").$this->unichr("102E")."/u";#
		$replacement[$j] = $this->unichr("1026");# ဥ
		
		$j++;
		
		//$pattern[$j]="/".$this->unichr("100A")."/u";# 
		//$replacement[$j] = $this->unichr("106B");# 
		
		//$j++;
		
		$pattern[$j]="/".$this->unichr("101B")."(?=[".$shr."])/u";# 
		$replacement[$j] = $this->unichr("1090");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1040")."/u";# သုည
		$replacement[$j] = $zero;
		
		$j++;
		
		
		$pattern[$j]="/".$this->unichr("1014")."(?=[".$this->unichr("1039")."])/u";# 
		$replacement[$j] = $this->unichr("108F");# နငယ္
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1014")."(?=[".$shr."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("108F");# နငယ္
		
		$j++;
		
	//	$pattern[$j]="/".$this->unichr("1014").$this->unichr("102d")."(?=[".$shr."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
	//	$replacement[$j] = $this->unichr("108F").$this->unichr("102d");# နငယ္
	//	
	//	$j++;
		
	//	$pattern[$j]="/".$this->unichr("1014").$this->unichr("102e")."(?=[".$shr."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
	//	$replacement[$j] = $this->unichr("108F").$this->unichr("102e");# နငယ္
		
	//	$j++;
		//$pattern[$j]="/".$this->unichr("103A")."/u";#
		//$replacement[$j] = $this->unichr("1039");#
		
		//$j++;
		
			
		$pattern[$j]="/".$this->unichr("1012")."/u";# ဒေထြး ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1012");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1013")."/u";# ဓေအာက္ခ်ိုင့္ ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1013");#
		
		$j++;
		
		//$pattern[$j]="/[".$this->unichr("103D").$this->unichr("1087")."]/u";# ေဇာ္ဂ်ီဟထိုး
		//$replacement[$j] = $ha;# ယူနီကုဒ္ဟထိုးသို့ေျပာင္းရန္
		
		//$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("103E")."/u";# 
		$replacement[$j] = $ya.$ha;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("103D")."/u";# 
		$replacement[$j] = $this->unichr("107D").$this->unichr("103D");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103D").$this->unichr("103E")."/u";# 
		$replacement[$j] = $this->unichr("108A");
		
		$j++; 
		
		$pattern[$j]="/".$this->unichr("103E").$this->unichr("103D")."/u";#
		$replacement[$j] = $wa.$ha;#
		$j++;
		
		
		$pattern[$j]="/".$tallAA.$this->unichr("103A")."/u";#
		$replacement[$j] = $this->unichr("105A");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("103B").$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("103B").$this->unichr("1034");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("102D").$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("103B").$this->unichr("102D").$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("102D").$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("103B").$this->unichr("102D").$this->unichr("1034");
		
		$j++;
		
		$pattern[$j]="/".$vi.$ans."/u";#
		$replacement[$j] = $this->unichr("108E");
		
		$j++;
		
		$pattern[$j]="/".$uha.$u."/u";#
		$replacement[$j] = $this->unichr("1088");
		
		$j++;
		
		$pattern[$j]="/".$uha.$uu."/u";#
		$replacement[$j] = $this->unichr("1089");
		
		$j++;
		
	
		/////////////////
		/*
		$pattern[$j]="/(".$this->unichr("1094")."|".$this->unichr("1095").")/u";#
		$replacement[$j] = $db;
	
		$j++;
		
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}([".$this->unichr("1060").$this->unichr("1061").$this->unichr("1062").$this->unichr("1063").$this->unichr("1065").$this->unichr("1066").$this->unichr("1067").$this->unichr("1068").$this->unichr("1069").$this->unichr("1070").$this->unichr("1071").$this->unichr("1072").$this->unichr("1073").$this->unichr("1074").$this->unichr("1075").$this->unichr("1076").$this->unichr("1077").$this->unichr("1078").$this->unichr("1079").$this->unichr("107A").$this->unichr("107B").$this->unichr("107C").$this->unichr("1085")."])/u";#
		$replacement[$j] = "$1$3$2";#
	
		$j++;
		
		//////////////
		*/
		$pattern[$j]="/".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039")."/u";#
		$replacement[$j] = $this->unichr("1064");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("104E").$this->unichr("1004").$this->unichr("103A").$this->unichr("1038")."/u";#
		$replacement[$j] = $this->unichr("104E");#
		
		$j++;
	/*
		$pattern[$j]="/".$this->unichr("103F")."/u";#
		$replacement[$j] = $this->unichr("1086");#
		
		$j++;
		
	*/
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1000")."/u";#
		$replacement[$j] = $this->unichr("1060");#
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1001")."/u";#
		$replacement[$j] = $this->unichr("1061");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1002")."/u";#
		$replacement[$j] = $this->unichr("1062");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1003")."/u";
		$replacement[$j] = $this->unichr("1063");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1005")."/u";#
		$replacement[$j] = $this->unichr("1065");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1006")."/u";#
		$replacement[$j] = $this->unichr("1066");#.$this->unichr("1067")
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1007")."/u";#
		$replacement[$j] = $this->unichr("1068");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1008")."/u";#
		$replacement[$j] = $this->unichr("1069");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("100B")."/u";#
		$replacement[$j] = $this->unichr("106C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("100F")."/u";#
		$replacement[$j] = $this->unichr("1070");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1010")."/u";#
		$replacement[$j] = $this->unichr("1071");#.$this->unichr("1072")
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1011")."/u";#
		$replacement[$j] = $this->unichr("1073");#.$this->unichr("1074")
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1012")."/u";#
		$replacement[$j] = $this->unichr("1075");#
		
		$j++;
		
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1013")."/u";#
		$replacement[$j] = $this->unichr("1076");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1014")."/u";#
		$replacement[$j] = $this->unichr("1077");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1015")."/u";#
		$replacement[$j] = $this->unichr("1078");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1016")."/u";#
		$replacement[$j] = $this->unichr("1079");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1017")."/u";#
		$replacement[$j] = $this->unichr("107A");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1018")."/u";#
		$replacement[$j] = $this->unichr("107B");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1019")."/u";#
		$replacement[$j] = $this->unichr("107C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("101C")."/u";#
		$replacement[$j] = $this->unichr("1085");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100B").$this->unichr("1039").$this->unichr("100C")."/u";#
		$replacement[$j] = $this->unichr("1092");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("100C")."/u";#
		$replacement[$j] = $this->unichr("106D");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100F").$this->unichr("1039").$this->unichr("100D")."/u";#
		$replacement[$j] = $this->unichr("1091");#
		
		$j++;
			
		$pattern[$j]="/".$this->unichr("100B").$this->unichr("1039").$this->unichr("100C")."/u";#
		$replacement[$j] = $this->unichr("1092");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100B").$this->unichr("1039").$this->unichr("100B")."/u";#
		$replacement[$j] = $this->unichr("1097");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100E").$this->unichr("1039").$this->unichr("100D")."/u";#
		$replacement[$j] = $this->unichr("106F");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100D").$this->unichr("1039").$this->unichr("100D")."/u";#
		$replacement[$j] = $this->unichr("106E");#
		
		$j++;
	
	
		//$pattern[$j]="/(".$this->unichr("103C").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u";#
		//$replacement[$j] = "$2$1$3";#
		
		//$j++;
		
		
		//$pattern[$j]="/(".$this->unichr("103E").")?(".$this->unichr("103D").")?([".$this->unichr("103B").$this->unichr("103C")."])/u";
		//$replacement[$j] = "$3$2$1";
		
		//$j++;
	
		/*
		$pattern[$j]="/(".$this->unichr("103E").")(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";#
		$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");#
		
		$j++;
		
		
		$pattern[$j]="/(".$this->unichr("103E").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";#
		$replacement[$j] = "$2$1";
		
		$j++;
		*/
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		//$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		//$replacement[$j] ="$2$3$6$1$4$9$7$5$8";#
		
		//$j++;
		/*
		$pattern[$j]="/".$ans.$u."/u";#
		$replacement[$j] = $u.$ans;#
		
		$j++;
	
		$pattern[$j]="/(".$this->unichr("103A").")(".$this->unichr("1037").")/u";#
		$replacement[$j] = "$2$1";#
		
		$j++;*/
		$pattern[$j]="/(?<=[".$zglower."])".$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("1033");#
		
		$j++;
		
	//	$pattern[$j]="/".$this->unichr("1014")."(?=[".$zglower."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
	//	$replacement[$j] = $this->unichr("108F");# နငယ္
		
	//	$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("103C")."$1".$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("103C")."$1".$this->unichr("1034");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."([".$this->unichr("1000")."-".$this->unichr("1021")."][".$up."])".$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("103C")."$1".$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."([".$this->unichr("1000")."-".$this->unichr("1021")."][".$up."])".$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("103C")."$1".$this->unichr("1034");
		
		$j++;

		$pattern[$j]="/[".$this->unichr("103C")."](?=[".$raW."][".$shr."][".$up."])/u";# 
		$replacement[$j] = $this->unichr("1084"); # 
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103C").$this->unichr("1084")."]([".$raW."][".$shr."][".$up."])".$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("1084")."$1".$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103C").$this->unichr("1084")."]([".$raW."][".$shr."][".$up."])".$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("1084")."$1".$this->unichr("1034");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."(?=[".$raW."][".$up."])/u";# 
		$replacement[$j] = $this->unichr("1080"); # 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."(?=[".$raW."][".$shr."])/u";# 
		$replacement[$j] = $this->unichr("1082"); # 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103C")."(?=[".$raW."])/u";# 
		$replacement[$j] = $this->unichr("107E"); # 
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103C")."](?=[".$raN."][".$shr."][".$up."])/u";# 
		$replacement[$j] = $this->unichr("1083"); # 
		
		$j++;

		
		$pattern[$j]="/[".$this->unichr("103C").$this->unichr("1083")."]([".$raN."][".$shr."][".$up."])".$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("1083")."$1".$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103C").$this->unichr("1083")."]([".$raN."][".$shr."][".$up."])".$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("1083")."$1".$this->unichr("1034");
		
		$j++;
				
		$pattern[$j]="/".$this->unichr("103C")."(?=[".$raN."][".$up."])/u";# 
		$replacement[$j] = $this->unichr("107F"); # 
		
		$j++;
				
		$pattern[$j]="/".$this->unichr("103C")."(?=[".$raN."][".$shr."])/u";# 
		$replacement[$j] = $this->unichr("1081"); # 
		
		$j++;
						
		$pattern[$j]="/".$this->unichr("103A")."/u";# ^".$this->unichr("1038")."
		$replacement[$j] = $this->unichr("1039"); # 
		
		$j++;	
		$pattern[$j]="/".$this->unichr("103B")."/u";# 
		$replacement[$j] = $this->unichr("103A"); # 
		
		$j++;	
		$pattern[$j]="/".$this->unichr("103C")."/u";# 
		$replacement[$j] = $this->unichr("103B"); # 
		
		$j++;
		$pattern[$j]="/".$this->unichr("103D")."/u";# 
		$replacement[$j] = $this->unichr("103C"); # 
		
		$j++;
		$pattern[$j]="/".$this->unichr("103E")."/u";# 
		$replacement[$j] = $this->unichr("103D"); # 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103F")."/u";# 
		$replacement[$j] = $this->unichr("1086"); # 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("103C")."/u";#
		$replacement[$j] = $this->unichr("103A").$this->unichr("103D");
		
		$j++;
		
		$pattern[$j]="/(?<=[".$up."])".$this->unichr("1037")."/u";# 
		$replacement[$j] = $this->unichr("1094"); # 
		
		$j++;
		
		$pattern[$j]="/(?<=[".$this->unichr("102F").$this->unichr("1030").$this->unichr("1033").$this->unichr("1034")."])".$this->unichr("1037")."/u";# 
		$replacement[$j] = $this->unichr("1095"); # 
		
		$j++;

		$pattern[$j]="/".$this->unichr("103D").$this->unichr("102F")."/u";# 
		$replacement[$j] = $this->unichr("1088"); # 
		
		$j++;
		
		//$pattern[$j]="/".$this->unichr("200B")."/u";# 
		//$replacement[$j] = $this->unichr("007C"); # 

		//$j++;
						   ///
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
		
	}
	
	function uni_zg($txt)
	{
		$tallAA=$this->unichr("102B");#-ါ
		$AA=$this->unichr("102C");#-ာ
		$vi=$this->unichr("102D");#- ိ
		
		//lone gyi tin
		$ii=$this->unichr("102E");# -ီ ေဇာ္ဂ်ီ၊  ယူနီကုဒ္ တူ
		$u=$this->unichr("102F");# -ု တစ္ေခ်ာင္းငင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$uu=$this->unichr("1030");# -ူ နွစ္ေခ်ာင္းငင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$ve=$this->unichr("1031");# ေ သေဝထိုး ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		
		$ai = $this->unichr("1032");#  ဲ ေနာက္ထိုးပစ္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$ans = $this->unichr("1036");# -ံ ေသးေသးတင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ 
		$db = $this->unichr("1037");# -့ ေအာက္ကျမင့္ ေဇာ္ဂ်ီ ယူနီကုဒ္ တူ ေဇာ္ဂ်ီမွာ သံုးမ်ိုး u1094 u1095
		$visarga = $this->unichr("1038");# -း ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
	
		$asat = $this->unichr("1039");#
	
		$ya = $this->unichr("103A");# 
		$ra = $this->unichr("103B");# 
		$wa = $this->unichr("103C");# 
		$ha = $this->unichr("103D");# 
		$uha = $this->unichr("103E");
		$zero = $this->unichr("1040");# သုည ဂဏန္း
		$shr = $this->unichr("102F").$this->unichr("1030").$this->unichr("1037").$this->unichr("103D").$this->unichr("103E").$this->unichr("1087").$this->unichr("1088").$this->unichr("1089");
		$up = $this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036").$this->unichr("1039").$this->unichr("1064").$this->unichr("108C").$this->unichr("108D").$this->unichr("108E");
		$raW = $this->unichr("1000").$this->unichr("1003").$this->unichr("100F").$this->unichr("1010").$this->unichr("1011").$this->unichr("1018").$this->unichr("101A").$this->unichr("101C").$this->unichr("101E").$this->unichr("101F").$this->unichr("1021");
		//$cons = $this->unichr("1000")-$this->unichr("1021");
		
		$j=0;

		/////Reordering/////
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("103C").")?(".$this->unichr("1031").")?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")/u"; 
	
		$replacement[$j] = $this->unichr("200B")."$3$2$1$4";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")(".$this->unichr("1031").")(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").$this->unichr("102D").")/u"; //
	
		$replacement[$j] = $this->unichr("200B")."$3$2$1$4";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")(".$this->unichr("102D").")/u"; //
	
		$replacement[$j] = "$1".$this->unichr("200B")."$4$3$2$5";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")(".$this->unichr("1031").")/u"; //
	
		$replacement[$j] = $this->unichr("200B")."$3$2$1";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103B").")(".$this->unichr("1031").")/u"; //
	
		$replacement[$j] = "$3$1$2";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103D").")?(".$this->unichr("103E").")?(".$this->unichr("1031").")/u"; //
	
		$replacement[$j] = $this->unichr("200B")."$4$1$2$3";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u"; 
	
		$replacement[$j] = "$1$3$2";
	
		$j++;
			
	
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}(".$this->unichr("1039")."([".$this->unichr("1000").$this->unichr("1001").$this->unichr("1002").$this->unichr("1003").$this->unichr("1005").$this->unichr("1006").$this->unichr("1007").$this->unichr("1008").$this->unichr("100B").$this->unichr("100C").$this->unichr("100F").$this->unichr("1010").$this->unichr("1011").$this->unichr("1012").$this->unichr("1013").$this->unichr("1014").$this->unichr("1015").$this->unichr("1016").$this->unichr("1017").$this->unichr("1018").$this->unichr("1019").$this->unichr("101C")."]))/u";
		$replacement[$j] = "$1$3$2";
	
		$j++;
		
		//$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("103B")."-".$this->unichr("103E")."])?([".$this->unichr("103B")."-".$this->unichr("103E")."])?([".$this->unichr("103B")."-".$this->unichr("103E")."])(".$this->unichr("1031").")/u";
	//	$replacement[$j] = "$5$1$2$3$4";
		
	//	$j++;

	//	$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("103B")."-".$this->unichr("103E")."])(".$this->unichr("1031").")/u";
	//	$replacement[$j] = "$3$2$1";
		
	//	$j++;		
		
	
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1031").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		

		$pattern[$j]="/(".$this->unichr("103D").")(".$this->unichr("103B").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		//$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		//$replacement[$j] ="$2$3$6$1$4$9$7$5$8";
		
		//$j++;
		
	//	$pattern[$j]="/".$ans.$u."/u";
//		$replacement[$j] = $u.$ans;
	//	
	//	$j++;
	
		$pattern[$j]="/(".$this->unichr("1037").")(".$this->unichr("103A").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;

		
		$pattern[$j]="/".$this->unichr("1009")."(?=[".$shr."])/u";# 
		$replacement[$j] = $this->unichr("106A");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1009")."(?=[".$this->unichr("103A").$this->unichr("102C")."])/u";# 
		$replacement[$j] = $this->unichr("1025");#
	
		$j++;
	
		$pattern[$j]="/".$this->unichr("1025").$this->unichr("102E")."/u";#
		$replacement[$j] = $this->unichr("1026");# ဥ
		
		$j++;
		
		//$pattern[$j]="/".$this->unichr("100A")."/u";# 
		//$replacement[$j] = $this->unichr("106B");# 
		
		//$j++;
		
		$pattern[$j]="/".$this->unichr("101B")."(?=[".$shr."])/u";# 
		$replacement[$j] = $this->unichr("1090");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1040")."/u";# သုည
		$replacement[$j] = $zero;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1014")."(?=[".$shr."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("108F");# နငယ္

		$j++;
		
		
		$pattern[$j]="/".$this->unichr("1014").$this->unichr("102d")."(?=[".$shr."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("108F").$this->unichr("102d");# နငယ္
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1014").$this->unichr("102e")."(?=[".$shr."])/u";# န ငယ္တို ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("108F").$this->unichr("102e");# နငယ္
		
		$j++;
		//$pattern[$j]="/".$this->unichr("103A")."/u";#
		//$replacement[$j] = $this->unichr("1039");#
		
		//$j++;
		
			
		$pattern[$j]="/".$this->unichr("1012")."/u";# ဒေထြး ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1012");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1013")."/u";# ဓေအာက္ခ်ိုင့္ ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1013");#
		
		$j++;
		
		//$pattern[$j]="/[".$this->unichr("103D").$this->unichr("1087")."]/u";# ေဇာ္ဂ်ီဟထိုး
		//$replacement[$j] = $ha;# ယူနီကုဒ္ဟထိုးသို့ေျပာင္းရန္
		
		//$j++;
				
		$j++; 
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("103E")."/u";# 
		$replacement[$j] = $ya.$ha;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("103D")."/u";# 
		$replacement[$j] = $this->unichr("107D").$this->unichr("103D");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103D").$this->unichr("103E")."/u";# 
		$replacement[$j] = "$0".$this->unichr("108A");
		
		$j++; 
	
		$pattern[$j]="/".$this->unichr("103E").$this->unichr("103D")."/u";#
		$replacement[$j] = $wa.$ha;#
		$j++;
		
		
		$pattern[$j]="/".$tallAA.$this->unichr("103A")."/u";#
		$replacement[$j] = $this->unichr("105A");
		
		$j++;
		
		$pattern[$j]="/".$vi.$ans."/u";#
		$replacement[$j] = $this->unichr("108E");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("102F")."/u";#
		$replacement[$j] = $this->unichr("103B").$this->unichr("1033");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103B").$this->unichr("1030")."/u";#
		$replacement[$j] = $this->unichr("103B").$this->unichr("1034");
		
		$j++;
		
		$pattern[$j]="/".$uha.$u."/u";#
		$replacement[$j] = $this->unichr("1088");
		
		$j++;
		
		$pattern[$j]="/".$uha.$uu."/u";#
		$replacement[$j] = $this->unichr("1089");
		
		$j++;
		
	
		/////////////////
		/*
		$pattern[$j]="/(".$this->unichr("1094")."|".$this->unichr("1095").")/u";#
		$replacement[$j] = $db;
	
		$j++;
		
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}([".$this->unichr("1060").$this->unichr("1061").$this->unichr("1062").$this->unichr("1063").$this->unichr("1065").$this->unichr("1066").$this->unichr("1067").$this->unichr("1068").$this->unichr("1069").$this->unichr("1070").$this->unichr("1071").$this->unichr("1072").$this->unichr("1073").$this->unichr("1074").$this->unichr("1075").$this->unichr("1076").$this->unichr("1077").$this->unichr("1078").$this->unichr("1079").$this->unichr("107A").$this->unichr("107B").$this->unichr("107C").$this->unichr("1085")."])/u";#
		$replacement[$j] = "$1$3$2";#
	
		$j++;
		
		//////////////
		*/
		$pattern[$j]="/".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039")."/u";#
		$replacement[$j] = $this->unichr("1064");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("104E").$this->unichr("1004").$this->unichr("103A").$this->unichr("1038")."/u";#
		$replacement[$j] = $this->unichr("104E");#
		
		$j++;
	/*
		$pattern[$j]="/".$this->unichr("103F")."/u";#
		$replacement[$j] = $this->unichr("1086");#
		
		$j++;
		
	*/
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1000")."/u";#
		$replacement[$j] = $this->unichr("1060");#
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1001")."/u";#
		$replacement[$j] = $this->unichr("1061");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1002")."/u";#
		$replacement[$j] = $this->unichr("1062");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1003")."/u";
		$replacement[$j] = $this->unichr("1063");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1005")."/u";#
		$replacement[$j] = $this->unichr("1065");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1006")."/u";#
		$replacement[$j] = $this->unichr("1066");#.$this->unichr("1067")
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1007")."/u";#
		$replacement[$j] = $this->unichr("1068");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1008")."/u";#
		$replacement[$j] = $this->unichr("1069");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("100B")."/u";#
		$replacement[$j] = $this->unichr("106C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("100F")."/u";#
		$replacement[$j] = $this->unichr("1070");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1010")."/u";#
		$replacement[$j] = $this->unichr("1071");#.$this->unichr("1072")
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1011")."/u";#
		$replacement[$j] = $this->unichr("1073");#.$this->unichr("1074")
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1012")."/u";#
		$replacement[$j] = $this->unichr("1075");#
		
		$j++;
		
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1013")."/u";#
		$replacement[$j] = $this->unichr("1076");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1014")."/u";#
		$replacement[$j] = $this->unichr("1077");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1015")."/u";#
		$replacement[$j] = $this->unichr("1078");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1016")."/u";#
		$replacement[$j] = $this->unichr("1079");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1017")."/u";#
		$replacement[$j] = $this->unichr("107A");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1018")."/u";#
		$replacement[$j] = $this->unichr("107B");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("1019")."/u";#
		$replacement[$j] = $this->unichr("107C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("101C")."/u";#
		$replacement[$j] = $this->unichr("1085");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100B").$this->unichr("1039").$this->unichr("100C")."/u";#
		$replacement[$j] = $this->unichr("1092");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1039").$this->unichr("100C")."/u";#
		$replacement[$j] = $this->unichr("106D");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100F").$this->unichr("1039").$this->unichr("100D")."/u";#
		$replacement[$j] = $this->unichr("1091");#
		
		$j++;
			
		$pattern[$j]="/".$this->unichr("100B").$this->unichr("1039").$this->unichr("100C")."/u";#
		$replacement[$j] = $this->unichr("1092");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100B").$this->unichr("1039").$this->unichr("100B")."/u";#
		$replacement[$j] = $this->unichr("1097");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100E").$this->unichr("1039").$this->unichr("100D")."/u";#
		$replacement[$j] = $this->unichr("106F");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("100D").$this->unichr("1039").$this->unichr("100D")."/u";#
		$replacement[$j] = $this->unichr("106E");#
		
		$j++;
	
	
		//$pattern[$j]="/(".$this->unichr("103C").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u";#
		//$replacement[$j] = "$2$1$3";#
		
		//$j++;
		
		
		//$pattern[$j]="/(".$this->unichr("103E").")?(".$this->unichr("103D").")?([".$this->unichr("103B").$this->unichr("103C")."])/u";
		//$replacement[$j] = "$3$2$1";
		
		//$j++;
	
		/*
		$pattern[$j]="/(".$this->unichr("103E").")(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";#
		$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");#
		
		$j++;
		
		
		$pattern[$j]="/(".$this->unichr("103E").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";#
		$replacement[$j] = "$2$1";
		
		$j++;
		*/
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		//$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		//$replacement[$j] ="$2$3$6$1$4$9$7$5$8";#
		
		//$j++;
		/*
		$pattern[$j]="/".$ans.$u."/u";#
		$replacement[$j] = $u.$ans;#
		
		$j++;
	
		$pattern[$j]="/(".$this->unichr("103A").")(".$this->unichr("1037").")/u";#
		$replacement[$j] = "$2$1";#
		
		$j++;*/

		//$pattern[$j]="/".$this->unichr("103C")."(?=[".$raW."])(?=[".$shr."])/u";# 
		//$replacement[$j] = $this->unichr("1082"); # 
		
		//$j++;
				
		$pattern[$j]="/".$this->unichr("103C")."(?=[".$raW."])/u";# 
		$replacement[$j] = $this->unichr("107E"); # 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103A")."/u";# ^".$this->unichr("1038")."
		$replacement[$j] = $this->unichr("1039"); # 
		
		$j++;	
		$pattern[$j]="/".$this->unichr("103B")."/u";# 
		$replacement[$j] = $this->unichr("103A"); # 
		
		$j++;	
		$pattern[$j]="/".$this->unichr("103C")."/u";# 
		$replacement[$j] = $this->unichr("103B"); # 
		
		$j++;
		$pattern[$j]="/".$this->unichr("103D")."/u";# 
		$replacement[$j] = $this->unichr("103C"); # 
		
		$j++;
		$pattern[$j]="/".$this->unichr("103E")."/u";# 
		$replacement[$j] = $this->unichr("103D"); # 
		
		$j++;

		$pattern[$j]="/".$this->unichr("1039").$this->unichr("103C")."/u";#
		$replacement[$j] = $this->unichr("103A").$this->unichr("103D");
		
		$j++;
		
		//$pattern[$j]="/".$this->unichr("200B")."/u";# 
		//$replacement[$j] = $this->unichr("007C"); # 

		//$j++;
	   ///
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
		
	}

			
	function zg_ayar($txt)
	{
		$tallAA=$this->unichr("102B");#-ါ
		$AA=$this->unichr("102C");#-ာ
		$vi=$this->unichr("102D");#- ိ
		
		//lone gyi tin
		$ii=$this->unichr("102E");# -ီ ေဇာ္ဂ်ီ၊  ယူနီကုဒ္ တူ
		$u=$this->unichr("102F");# -ု တစ္ေခ်ာင္းငင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$uu=$this->unichr("1030");# -ူ နွစ္ေခ်ာင္းငင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$ve=$this->unichr("1031");# ေ သေဝထိုး ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		
		$ai = $this->unichr("1032");#  ဲ ေနာက္ထိုးပစ္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
		$ans = $this->unichr("1036");# -ံ ေသးေသးတင္ ေဇာ္ဂ်ီ ယူနီကုဒ္တူ 
		$db = $this->unichr("1037");# -့ ေအာက္ကျမင့္ ေဇာ္ဂ်ီ ယူနီကုဒ္ တူ ေဇာ္ဂ်ီမွာ သံုးမ်ိုး u1094 u1095
		$visarga = $this->unichr("1038");# -း ေဇာ္ဂ်ီ ယူနီကုဒ္တူ
	
		$asat = $this->unichr("103A");# -္ ယူနီကုဒ္ အသတ္ ၊ -် ေဇာ္ဂ်ီယပင့္ 
	
		$ya = $this->unichr("103B");# --် ယူနီကုဒ္ ယပင့္၊  ျ-  ေဇာ္ဂ်ီ ရရစ္
		$ra = $this->unichr("103C");# ျ-- ယူနီကုဒ္ ရရစ္၊  -ြ ေဇာ္ဂ်ီ ဝဆြဲ
		$wa = $this->unichr("103D");# --ြ ယူနီကုဒ္ ဝဆြဲ ၊  --ွ ေဇာ္ဂ်ီ ဟထိုး
		$ha = $this->unichr("103E");# ေဇာ္ဂ်ီမွာ မရွိ ေဇာ္ဂ်ီ ၂၀၀၉ မွာ ေရွ့ထိုး ယူနီကုဒ္မွာ ဟထိုး
		$zero = $this->unichr("1040");# သုည ဂဏန္း
		
		$j=0;
		
		$pattern[$j]="/".$this->unichr("106A")."/u";# ဥ (ေရွ့နဲ့ေနာက္မွာ တြဲတာရွိရင္ ည ေလးကိုေျပာင္းရန္)
		$replacement[$j] = $this->unichr("1009");# ဉ     - ညေလး
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1025")."(?=[".$this->unichr("1039").$this->unichr("102C")."])/u";# ဥ (ေနာက္မွာ အသတ္ သို့မဟုတ္ ေရးခ် ရွိရင္ ညေလးကိုေျပာင္း)
		$replacement[$j] = $this->unichr("1009");# ဉ     - ညေလး
	
		$j++;
	
		$pattern[$j]="/".$this->unichr("1025").$this->unichr("102E")."/u";# ဥ (လံုးျကီးတင္ဆံခတ္ ပါရင္ ဥ ပဲ ညေလးမဟုတ္)
		$replacement[$j] = $this->unichr("1026");# ဥ
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106B")."/u";#  ည (ေဇာ္ဂ်ီ)
		$replacement[$j] = $this->unichr("100A");# ည (ယူနီကုဒ္)
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1090")."/u";# ရ ေကာက္တို ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("101B");# ရ ေကာက္
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1040")."/u";# သုည
		$replacement[$j] = $zero;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("108F")."/u";# န ငယ္တို ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1014");# နငယ္
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1012")."/u";# ဒေထြး ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1012");# 
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1013")."/u";# ဓေအာက္ခ်ိုင့္ ေဇာ္ဂ်ီ
		$replacement[$j] = $this->unichr("1013");#
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103D").$this->unichr("1087")."]/u";# ေဇာ္ဂ်ီဟထိုး
		$replacement[$j] = $ha;# ယူနီကုဒ္ဟထိုးသို့ေျပာင္းရန္
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("103C")."/u";# ေဇာ္ဂ်ီ ဝဆြဲ
		
		$replacement[$j] = $wa;# ယူနီကုဒ္ ဝဆြဲသို့ေျပာင္းရန္
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103B").$this->unichr("107E").$this->unichr("107F").$this->unichr("1080").$this->unichr("1081").$this->unichr("1082").$this->unichr("1083").$this->unichr("1084")."]/u";# ေဇာ္ဂ်ီ ရရစ္မ်ား
		$replacement[$j] = $ra; #ယူနီကုဒ္ ရရစ္သို့ေျပာင္းရန္
		
		$j++;
		
		
		$pattern[$j]="/[".$this->unichr("103A").$this->unichr("107D")."]/u";# ေဇာ္ဂ်ီ ယပင့္နွစ္ခု
		$replacement[$j] = $ya; # ယူနီကုဒ္ ယပင့္သို့ေျပာင္းရန္
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103E").$this->unichr("103B")."/u";# ေဇာ္ဂ်ီ ရရစ္ ဟထိုး
		$replacement[$j] = $ya.$ha;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("108A")."/u";# -ြွ  ဝဆြဲဟထိုး
		$replacement[$j] = $wa.$ha;
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("103E").$this->unichr("103D")."/u";#ဝဆြဲဟထိုး
		$replacement[$j] = $wa.$ha;#
		$j++;
		
		
		/////Reordering/////
		//$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("1064")."/u";#
	
		//$replacement[$j] = $this->unichr("1064")."$1$2$3";#
	
		//$j++;
		
		//$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("108B")."/u";#
		
		//$replacement[$j] = $this->unichr("1064")."$1$2$3".$this->unichr("102D");#
		
		//$j++;
		
		//$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("108C")."/u";#
		
		//$replacement[$j] = $this->unichr("1064")."$1$2$3".$this->unichr("102E");#
		
		//$j++;
		
		//$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("108D")."/u";#
		
		//$replacement[$j] = $this->unichr("1064")."$1$2$3".$this->unichr("1036");#
		
		//$j++;
		///////////////////
		
		$pattern[$j]="/".$this->unichr("105A")."/u";#
		$replacement[$j] = $tallAA.$asat;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("108E")."/u";#
		$replacement[$j] = $vi.$ans;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1033")."/u";#
		$replacement[$j] = $u;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1034")."/u";#
		$replacement[$j] = $uu;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1088")."/u";#
		$replacement[$j] = $ha.$u;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1089")."/u";#
		$replacement[$j] = $ha.$uu;
		
		$j++;
		
		/////////////////
		
		$pattern[$j]="/".$this->unichr("1039")."/u";#
		$replacement[$j] = $this->unichr("103A");#
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1094")."|".$this->unichr("1095").")/u";#
		$replacement[$j] = $db;
	
		$j++;
		
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}([".$this->unichr("1060").$this->unichr("1061").$this->unichr("1062").$this->unichr("1063").$this->unichr("1065").$this->unichr("1066").$this->unichr("1067").$this->unichr("1068").$this->unichr("1069").$this->unichr("1070").$this->unichr("1071").$this->unichr("1072").$this->unichr("1073").$this->unichr("1074").$this->unichr("1075").$this->unichr("1076").$this->unichr("1077").$this->unichr("1078").$this->unichr("1079").$this->unichr("107A").$this->unichr("107B").$this->unichr("107C").$this->unichr("1085")."])/u";#
		$replacement[$j] = "$1$3$2";#
	
		$j++;
		
		//////////////
		
		$pattern[$j]="/".$this->unichr("1064")."/u";#
		$replacement[$j] = $this->unichr("1004").$this->unichr("103A").$this->unichr("1039");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("104E")."/u";#
		$replacement[$j] = $this->unichr("104E").$this->unichr("1004").$this->unichr("103A").$this->unichr("1038");#
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("1086")."/u";#
		$replacement[$j] = $this->unichr("103F");#
		
		$j++;
		
	
		$pattern[$j]="/".$this->unichr("1060")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1000");#
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("1061")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1001");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1062")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1002");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1063")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1003");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1065")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1005");#
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("1066").$this->unichr("1067")."]/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1006");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1068")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1007");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1069")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1008");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106C")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("100B");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1070")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("100F");#
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("1071").$this->unichr("1072")."]/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1010");#
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("1073").$this->unichr("1074")."]/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1011");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1075")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1012");#
		
		$j++;
		
		
		$pattern[$j]="/".$this->unichr("1076")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1013");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1077")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1014");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1078")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1015");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1079")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1016");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("107A")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1017");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("107B")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1018");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("107C")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("1019");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1085")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("101C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106D")."/u";#
		$replacement[$j] = $this->unichr("1039").$this->unichr("100C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1091")."/u";#
		$replacement[$j] = $this->unichr("100F").$this->unichr("1039").$this->unichr("100D");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1092")."/u";#
		$replacement[$j] = $this->unichr("100B").$this->unichr("1039").$this->unichr("100C");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1097")."/u";#
		$replacement[$j] = $this->unichr("100B").$this->unichr("1039").$this->unichr("100B");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106F")."/u";#
		$replacement[$j] = $this->unichr("100E").$this->unichr("1039").$this->unichr("100D");#
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106E")."/u";#
		$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");#
		
		$j++;
	
	
		//$pattern[$j]="/(".$this->unichr("103C").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u";#
		//$replacement[$j] = "$2$1$3";#
		
		//$j++;
		
		
		//$pattern[$j]="/(".$this->unichr("103E").")?(".$this->unichr("103D").")?([".$this->unichr("103B").$this->unichr("103C")."])/u";
		//$replacement[$j] = "$3$2$1";
		
		//$j++;
	
		
		$pattern[$j]="/(".$this->unichr("103E").")(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";#
		$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");#
		
		$j++;
		
		
		/*$pattern[$j]="/(".$this->unichr("103E").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		*/
		$pattern[$j]="/(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";#
		$replacement[$j] = "$2$1";
		
		$j++;
		
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		//$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		//$replacement[$j] ="$2$3$6$1$4$9$7$5$8";#
		
		//$j++;
		
		$pattern[$j]="/".$ans.$u."/u";#
		$replacement[$j] = $u.$ans;#
		
		$j++;
	
		$pattern[$j]="/(".$this->unichr("103A").")(".$this->unichr("1037").")/u";#
		$replacement[$j] = "$2$1";#
		
		$j++;
	
		//$pattern[$j]="/".$this->unichr("200B")."/u";# 
		//$replacement[$j] = $this->unichr("007C"); # 

		//$j++;
	   ///
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
		
	}
	
	function zg_uni($txt)
	{
		$tallAA=$this->unichr("102B");
		$AA=$this->unichr("102C");
		$vi=$this->unichr("102D");
		
		//lone gyi tin
		$ii=$this->unichr("102E");
		$u=$this->unichr("102F");
		$uu=$this->unichr("1030");
		$ve=$this->unichr("1031");
		
		$ai = $this->unichr("1032");
		$ans = $this->unichr("1036");
		$db = $this->unichr("1037");
		$visarga = $this->unichr("1038");
	
		$asat = $this->unichr("103A");
	
		$ya = $this->unichr("103B");
		$ra = $this->unichr("103C");
		$wa = $this->unichr("103D");
		$ha = $this->unichr("103E");
		$zero = $this->unichr("1040");
		
		$j=0;
		
		$pattern[$j]="/".$this->unichr("106A")."/u";
		$replacement[$j] = $this->unichr("1009");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1025")."(?=[".$this->unichr("1039").$this->unichr("102C")."])/u";
		$replacement[$j] = $this->unichr("1009");
	
		$j++;
	
		$pattern[$j]="/".$this->unichr("1025").$this->unichr("102E")."/u";
		$replacement[$j] = $this->unichr("1026");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106B")."/u";
		$replacement[$j] = $this->unichr("100A");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1090")."/u";
		$replacement[$j] = $this->unichr("101B");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1040")."/u";
		$replacement[$j] = $zero;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("108F")."/u";
		$replacement[$j] = $this->unichr("1014");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1012")."/u";
		$replacement[$j] = $this->unichr("1012");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1013")."/u";
		$replacement[$j] = $this->unichr("1013");
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103D").$this->unichr("1087")."]/u";
		$replacement[$j] = $ha;
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("103C")."/u";
		
		$replacement[$j] = $wa;
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("103B").$this->unichr("107E").$this->unichr("107F").$this->unichr("1080").$this->unichr("1081").$this->unichr("1082").$this->unichr("1083").$this->unichr("1084")."]/u";
		$replacement[$j] = $ra;
		
		$j++;
		
		
		$pattern[$j]="/[".$this->unichr("103A").$this->unichr("107D")."]/u";
		$replacement[$j] = $ya;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("103E").$this->unichr("103B")."/u";
		$replacement[$j] = $ya.$ha;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("108A")."/u";
		$replacement[$j] = $wa.$ha;
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("103E").$this->unichr("103D")."/u";
		$replacement[$j] = $wa.$ha;
		$j++;
		
		
		/////Reordering/////
		$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("1064")."/u";
	
		$replacement[$j] = $this->unichr("1064")."$1$2$3";
	
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("108B")."/u";
		
		$replacement[$j] = $this->unichr("1064")."$1$2$3".$this->unichr("102D");
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("108C")."/u";
		
		$replacement[$j] = $this->unichr("1064")."$1$2$3".$this->unichr("102E");
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])".$this->unichr("108D")."/u";
		
		$replacement[$j] = $this->unichr("1064")."$1$2$3".$this->unichr("1036");
		
		$j++;
		///////////////////
		
		$pattern[$j]="/".$this->unichr("105A")."/u";
		$replacement[$j] = $tallAA.$asat;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("108E")."/u";
		$replacement[$j] = $vi.$ans;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1033")."/u";
		$replacement[$j] = $u;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1034")."/u";
		$replacement[$j] = $uu;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1088")."/u";
		$replacement[$j] = $ha.$u;
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1089")."/u";
		$replacement[$j] = $ha.$uu;
		
		$j++;
		
		/////////////////
		
		$pattern[$j]="/".$this->unichr("1039")."/u";
		$replacement[$j] = $this->unichr("103A");
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1094")."|".$this->unichr("1095").")/u";
		$replacement[$j] = $db;
	
		$j++;
		
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}([".$this->unichr("1060").$this->unichr("1061").$this->unichr("1062").$this->unichr("1063").$this->unichr("1065").$this->unichr("1066").$this->unichr("1067").$this->unichr("1068").$this->unichr("1069").$this->unichr("1070").$this->unichr("1071").$this->unichr("1072").$this->unichr("1073").$this->unichr("1074").$this->unichr("1075").$this->unichr("1076").$this->unichr("1077").$this->unichr("1078").$this->unichr("1079").$this->unichr("107A").$this->unichr("107B").$this->unichr("107C").$this->unichr("1085")."])/u";
		$replacement[$j] = "$1$3$2";
	
		$j++;
		
		//////////////
		
		$pattern[$j]="/".$this->unichr("1064")."/u";
		$replacement[$j] = $this->unichr("1004").$this->unichr("103A").$this->unichr("1039");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("104E")."/u";
		$replacement[$j] = $this->unichr("104E").$this->unichr("1004").$this->unichr("103A").$this->unichr("1038");
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("1086")."/u";
		$replacement[$j] = $this->unichr("103F");
		
		$j++;
		
	
		$pattern[$j]="/".$this->unichr("1060")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1000");
		
		$j++;
	
		$pattern[$j]="/".$this->unichr("1061")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1001");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1062")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1002");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1063")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1003");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1065")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1005");
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("1066").$this->unichr("1067")."]/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1006");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1068")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1007");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1069")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1008");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106C")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("100B");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1070")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("100F");
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("1071").$this->unichr("1072")."]/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1010");
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("1073").$this->unichr("1074")."]/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1011");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1075")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1012");
		
		$j++;
		
		
		$pattern[$j]="/".$this->unichr("1076")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1013");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1077")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1014");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1078")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1015");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1079")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1016");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("107A")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1017");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("107B")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1018");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("107C")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("1019");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1085")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("101C");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106D")."/u";
		$replacement[$j] = $this->unichr("1039").$this->unichr("100C");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1091")."/u";
		$replacement[$j] = $this->unichr("100F").$this->unichr("1039").$this->unichr("100D");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1092")."/u";
		$replacement[$j] = $this->unichr("100B").$this->unichr("1039").$this->unichr("100C");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("1097")."/u";
		$replacement[$j] = $this->unichr("100B").$this->unichr("1039").$this->unichr("100B");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106F")."/u";
		$replacement[$j] = $this->unichr("100E").$this->unichr("1039").$this->unichr("100D");
		
		$j++;
		
		$pattern[$j]="/".$this->unichr("106E")."/u";
		$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");
		
		$j++;
	
	
		$pattern[$j]="/(".$this->unichr("103C").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u";
		$replacement[$j] = "$2$1$3";
		
		$j++;
		
		
		//$pattern[$j]="/(".$this->unichr("103E").")?(".$this->unichr("103D").")?([".$this->unichr("103B").$this->unichr("103C")."])/u";
		//$replacement[$j] = "$3$2$1";
		
		//$j++;
	
		
		$pattern[$j]="/(".$this->unichr("103E").")(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");
		
		$j++;
		
		
		/*$pattern[$j]="/(".$this->unichr("103E").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		*/
		$pattern[$j]="/(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		$replacement[$j] ="$2$3$6$1$4$9$7$5$8";
		
		$j++;
		
		$pattern[$j]="/".$ans.$u."/u";
		$replacement[$j] = $u.$ans;
		
		$j++;
	
		$pattern[$j]="/(".$this->unichr("103A").")(".$this->unichr("1037").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;

		//$pattern[$j]="/".$this->unichr("200B")."/u";# 
		//$replacement[$j] = $this->unichr("007C"); # 

		//$j++;	
	   ///
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
		
	}
	
	function ayar_uni($txt)
	{
		$tallAA=$this->unichr("102B");
		$AA=$this->unichr("102C");
		$vi=$this->unichr("102D");
		
		//lone gyi tin
		$ii=$this->unichr("102E");
		$u=$this->unichr("102F");
		$uu=$this->unichr("1030");
		$ve=$this->unichr("1031");
		
		$ai = $this->unichr("1032");
		$ans = $this->unichr("1036");
		$db = $this->unichr("1037");
		$visarga = $this->unichr("1038");
	
		$asat = $this->unichr("103A");
	
		$ya = $this->unichr("103B");
		$ra = $this->unichr("103C");
		$wa = $this->unichr("103D");
		$ha = $this->unichr("103E");
		$zero = $this->unichr("1040");
	
		$j=0;
		
		/////Reordering/////
		$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")/u"; 
	
		$replacement[$j] = "$4$1$2$3";
	
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1031").")?(".$this->unichr("103C").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").$this->unichr("102D").")/u"; 
	
		$replacement[$j] = "$4$1$2$3";
	
		$j++;
			
	
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}(".$this->unichr("1039")."([".$this->unichr("1000").$this->unichr("1001").$this->unichr("1002").$this->unichr("1003").$this->unichr("1005").$this->unichr("1006").$this->unichr("1007").$this->unichr("1008").$this->unichr("100B").$this->unichr("100C").$this->unichr("100F").$this->unichr("1010").$this->unichr("1011").$this->unichr("1012").$this->unichr("1013").$this->unichr("1014").$this->unichr("1015").$this->unichr("1016").$this->unichr("1017").$this->unichr("1018").$this->unichr("1019").$this->unichr("101C")."]))/u";
		$replacement[$j] = "$1$3$2";
	
		$j++;
		
		//////////////
	
		$pattern[$j]="/(".$this->unichr("103C").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u";
		$replacement[$j] = "$2$1$3";
		
		$j++;
		
		
		//$pattern[$j]="/(".$this->unichr("103E").")?(".$this->unichr("103D").")?([".$this->unichr("103B").$this->unichr("103C")."])/u";
		//$replacement[$j] = "$3$2$1";
		
		//$j++;
	
		
		//$pattern[$j]="/(".$this->unichr("103E").")(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		//$replacement[$j] = $this->unichr("100D").$this->unichr("1039").$this->unichr("100D");
		
		//$j++;
		
		
		/*$pattern[$j]="/(".$this->unichr("103E").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		*/
		$pattern[$j]="/(".$this->unichr("103D").")([".$this->unichr("103B").$this->unichr("103C")."])/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		$replacement[$j] ="$2$3$6$1$4$9$7$5$8";
		
		$j++;
		
		$pattern[$j]="/".$ans.$u."/u";
		$replacement[$j] = $u.$ans;
		
		$j++;

		//$pattern[$j]="/".$this->unichr("200B")."/u";# 
		//$replacement[$j] = $this->unichr("007C"); # 

		//$j++;		
	
	   ///
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
		
	}
	
	function uni_ayar($txt)
	{

		
		$ai = $this->unichr("1032");
		$ans = $this->unichr("1036");
		$db = $this->unichr("1037");
		$visarga = $this->unichr("1038");
	
		$asat = $this->unichr("103A");
	
		$ya = $this->unichr("103B");
		$ra = $this->unichr("103C");
		$wa = $this->unichr("103D");
		$ha = $this->unichr("103E");
		$zero = $this->unichr("1040");
	
		$j=0;
		
		/////Reordering/////
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("103C").")?(".$this->unichr("1031").")?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")/u"; 
	
		$replacement[$j] = $this->unichr("200B")."$3$2$1$4";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")(".$this->unichr("1031").")(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").$this->unichr("102D").")/u"; //
	
		$replacement[$j] = $this->unichr("200B")."$3$2$1$4";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")(".$this->unichr("102D").")/u"; //
	
		$replacement[$j] = "$1".$this->unichr("200B")."$4$3$2$5";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")(".$this->unichr("1031").")/u"; //
	
		$replacement[$j] = $this->unichr("200B")."$3$2$1";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103B").")(".$this->unichr("1031").")/u"; //
	
		$replacement[$j] = "$3$1$2";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103D").")?(".$this->unichr("103E").")?(".$this->unichr("1031").")/u"; //
	
		$replacement[$j] = $this->unichr("200B")."$4$1$2$3";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")([".$this->unichr("1000")."-".$this->unichr("1021")."])/u"; 
	
		$replacement[$j] = "$1$3$2";
	
		$j++;
			
	
		/////////////
		//pasint order , human error
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("102C").$this->unichr("102D").$this->unichr("102E").$this->unichr("1032").$this->unichr("1036")."]){1,2}(".$this->unichr("1039")."([".$this->unichr("1000").$this->unichr("1001").$this->unichr("1002").$this->unichr("1003").$this->unichr("1005").$this->unichr("1006").$this->unichr("1007").$this->unichr("1008").$this->unichr("100B").$this->unichr("100C").$this->unichr("100F").$this->unichr("1010").$this->unichr("1011").$this->unichr("1012").$this->unichr("1013").$this->unichr("1014").$this->unichr("1015").$this->unichr("1016").$this->unichr("1017").$this->unichr("1018").$this->unichr("1019").$this->unichr("101C")."]))/u";
		$replacement[$j] = "$1$3$2";
	
		$j++;
		
		//$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("103B")."-".$this->unichr("103E")."])?([".$this->unichr("103B")."-".$this->unichr("103E")."])?([".$this->unichr("103B")."-".$this->unichr("103E")."])(".$this->unichr("1031").")/u";
	//	$replacement[$j] = "$5$1$2$3$4";
		
	//	$j++;

	//	$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])([".$this->unichr("103B")."-".$this->unichr("103E")."])(".$this->unichr("1031").")/u";
	//	$replacement[$j] = "$3$2$1";
		
	//	$j++;		
		
	
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("103C").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1031").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		

		$pattern[$j]="/(".$this->unichr("103D").")(".$this->unichr("103B").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;
		
		
		//need to add 0 or wa
		
		// need to add 7 or ra
		
		//storage order rediner
		//$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("1000")."-".$this->unichr("1021")."])(".$this->unichr("1039")."[".$this->unichr("1000")."-".$this->unichr("1021")."])?([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("103B")."-".$this->unichr("103E")."]{0,3})([".$this->unichr("102F").$this->unichr("1030")."])?([".$this->unichr("1036").$this->unichr("1037").$this->unichr("1038")."]{0,2})([".$this->unichr("102D").$this->unichr("102E").$this->unichr("1032")."])?/u";
		//$replacement[$j] ="$2$3$6$1$4$9$7$5$8";
		
		//$j++;
		
	//	$pattern[$j]="/".$ans.$u."/u";
//		$replacement[$j] = $u.$ans;
	//	
	//	$j++;
	
		$pattern[$j]="/(".$this->unichr("1037").")(".$this->unichr("103A").")/u";
		$replacement[$j] = "$2$1";
		
		$j++;

		//$pattern[$j]="/".$this->unichr("200B")."/u";# 
		//$replacement[$j] = $this->unichr("007C"); # 

		//$j++;	
	   ///
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
		
	}
	
	function html_decode($constr)
	{	
		//change HTML to unicode
		
		$en_chr=array("&#4096;", "&#4097;", "&#4098;", "&#4099;", "&#4100;", "&#4101;", "&#4102;", "&#4103;", "&#4104;", "&#4105;", "&#4106;", "&#4107;", "&#4108;", "&#4109;", "&#4110;", "&#4111;", "&#4112;", "&#4113;", "&#4114;", "&#4115;", "&#4116;", "&#4117;", "&#4118;", "&#4119;", "&#4120;", "&#4121;", "&#4122;", "&#4123;", "&#4124;", "&#4125;", "&#4126;", "&#4127;", "&#4128;", "&#4129;", "&#4130;", "&#4131;", "&#4132;", "&#4133;", "&#4134;", "&#4135;", "&#4136;", "&#4137;", "&#4138;", "&#4139;", "&#4140;", "&#4141;", "&#4142;", "&#4143;", "&#4144;", "&#4145;", "&#4146;", "&#4147;", "&#4148;", "&#4149;", "&#4150;", "&#4151;", "&#4152;", "&#4153;", "&#4154;", "&#4155;", "&#4156;", "&#4157;", "&#4158;", "&#4159;", "&#4160;", "&#4161;", "&#4162;", "&#4163;", "&#4164;", "&#4165;", "&#4166;", "&#4167;", "&#4168;", "&#4169;", "&#4170;", "&#4171;", "&#4172;", "&#4173;", "&#4174;", "&#4175;", "&#4176;", "&#4177;", "&#4178;", "&#4179;", "&#4180;", "&#4181;", "&#4182;", "&#4183;", "&#4184;", "&#4185;", "&#4186;", "&#4187;", "&#4188;", "&#4189;", "&#4190;", "&#4191;", "&#4192;", "&#4193;", "&#4194;", "&#4195;", "&#4196;", "&#4197;", "&#4198;", "&#4199;", "&#4200;", "&#4201;", "&#4202;", "&#4203;", "&#4204;", "&#4205;", "&#4206;", "&#4207;", "&#4208;", "&#4209;", "&#4210;", "&#4211;", "&#4212;", "&#4213;", "&#4214;", "&#4215;", "&#4216;", "&#4217;", "&#4218;", "&#4219;", "&#4220;", "&#4221;", "&#4222;", "&#4223;", "&#4224;", "&#4225;", "&#4226;", "&#4227;", "&#4228;", "&#4229;", "&#4230;", "&#4231;", "&#4232;", "&#4233;", "&#4234;", "&#4235;", "&#4236;", "&#4237;", "&#4238;", "&#4239;", "&#4240;", "&#4241;", "&#4242;", "&#4243;", "&#4244;", "&#4245;", "&#4246;", "&#4247;", "&#4248;", "&#4249;", "&#4250;", "&#4251;", "&#4252;", "&#4253;", "&#4254;", "&#4255;");
	
		$utf8_chr=array("က", "ခ", "ဂ", "ဃ", "င", "စ", "ဆ", "ဇ", "ဈ", "ဉ", "ည", "ဋ", "ဌ", "ဍ", "ဎ", "ဏ", "တ", "ထ", "ဒ", "ဓ", "န", "ပ", "ဖ", "ဗ", "ဘ", "မ", "ယ", "ရ", "လ", "ဝ", "သ", "ဟ", "ဠ", "အ", "ဢ", "ဣ", "ဤ", "ဥ", "ဦ", "ဧ", "ဨ", "ဩ", "ဪ", "ါ", "ာ", "ိ", "ီ", "ု", "ူ", "ေ", "ဲ", "ဳ", "ဴ", "ဵ", "ံ", "့", "း", "္", "်", "ျ", "ြ", "ွ", "ှ", "ဿ", "၀", "၁", "၂", "၃", "၄", "၅", "၆", "၇", "၈", "၉", "၊", "။", "၌", "၍", "၎", "၏", "ၐ", "ၑ", "ၒ", "ၓ", "ၔ", "ၕ", "ၖ", "ၗ", "ၘ", "ၙ", "ၚ", "ၛ", "ၜ", "ၝ", "ၞ", "ၟ", "ၠ", "ၡ", "ၢ", "ၣ", "ၤ", "ၥ", "ၦ", "ၧ", "ၨ", "ၩ", "ၪ", "ၫ", "ၬ", "ၭ", "ၮ", "ၯ", "ၰ", "ၱ", "ၲ", "ၳ", "ၴ", "ၵ", "ၶ", "ၷ", "ၸ", "ၹ", "ၺ", "ၻ", "ၼ", "ၽ", "ၾ", "ၿ", "ႀ", "ႁ", "ႂ", "ႃ", "ႄ", "ႅ", "ႆ", "ႇ", "ႈ", "ႉ", "ႊ", "ႋ", "ႌ", "ႍ", "ႎ", "ႏ", "႐", "႑", "႒", "႓", "႔", "႕", "႖", "႗", "႘", "႙", "ႚ", "ႛ", "ႜ", "ႝ", "႞", "႟");
		
		
		$last=str_replace($en_chr,$utf8_chr,$constr);
		return $last;
		
	}
	
	static function FormatElapsed($Start, $End = NULL) {
		  if($End === NULL)
			 $Elapsed = $Start;
		  else
			 $Elapsed = $End - $Start;
	
		  $m = floor($Elapsed / 60);
		  $s = $Elapsed - $m * 60;
		  $Result = sprintf('%02d:%05.2f', $m, $s);
	
		  return $Result;
	}
	
	/*
	Log Files
	*/
	function start_log()
	{
		//start time
		$this->fh = fopen($this->logfile, 'w') or die("can't open file");
		$this->BeginTime=microtime(true);
	}
	
	function decodedone_log()
	{
		fwrite($this->fh,"HTML Decode Done.\n");
	}
	
	function end_log()
	{
		//end time
		$this->EndTime=microtime(true);
		fwrite($this->fh,"Total Time:");
		fwrite($this->fh, self::FormatElapsed($this->EndTime-$this->BeginTime));
		fclose($this->fh);
	}
}
$converter = new CONVERTER();
?>
