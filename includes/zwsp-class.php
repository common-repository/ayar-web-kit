<?php
class ZWSP {
	
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
	function zwsp_zawgyi($txt)
	{
	
		$j=0;
		
				
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("102A")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("104D").$this->unichr("104E").$this->unichr("104F").$this->unichr("106A").$this->unichr("106B").$this->unichr("106E").$this->unichr("1086").$this->unichr("108F").$this->unichr("1090").$this->unichr("1091").$this->unichr("1092")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1038").")/u";
		$replacement[$j] = "$1".$this->unichr("200B");//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1037").")/u";
		$replacement[$j] = "$1".$this->unichr("200B");//added zwsp infront of all consonent.
		
		$j++;
		
	
		$pattern[$j]="/(".$this->unichr("1031").")?([".$this->unichr("103B").$this->unichr("107E").$this->unichr("107F").$this->unichr("1080").$this->unichr("1081").$this->unichr("1082").$this->unichr("1083").$this->unichr("1084")."])?([".$this->unichr("200B")."])([".$this->unichr("1000")."-".$this->unichr("1021")."])/u"; 
	
		$replacement[$j] = "$3$1$2$4";
	
		$j++;
	
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1039").")/u";
		$replacement[$j] = "$2$3";//remove zwsp infront of consonents if consonent is folled by asat.
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("103E").")([(".$this->unichr("200B").")])/u";
		$replacement[$j] = "$2$3";//remoze zwsp behind virama
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1031").$this->unichr("103B").$this->unichr("107E")."])?([".$this->unichr("200B")."])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("103E").")/u"; 
	
		$replacement[$j] = "$1$3$4".$this->unichr("200B");
	
		$j++;
		
		$pattern[$j]="/[".$this->unichr("200B")."]{2,}/u";
		$replacement[$j] = $this->unichr("200B");//two zwsp to one zwsp
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("0020")."])/u";
		$replacement[$j] = "$2";//remoze zwsp if there is space behind
		$j++;
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
	}
	function zwsp_ayar($txt)
	{
	
		$j=0;
		
				
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("102A")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("103F")."-".$this->unichr("1049")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("104C")."-".$this->unichr("104F")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1038").")/u";
		$replacement[$j] = "$1".$this->unichr("200B");
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1037").")/u";
		$replacement[$j] = "$1".$this->unichr("200B");
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1031").$this->unichr("103C").")?([".$this->unichr("200B")."])([".$this->unichr("1000")."-".$this->unichr("1021")."])/u"; 
	
		$replacement[$j] = "$2$1$3";
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1031").$this->unichr("103C")."])?([".$this->unichr("200B")."])([".$this->unichr("1000")."-".$this->unichr("1021")."])/u"; 
	
		$replacement[$j] = "$2$1$3";
	
		$j++;
	
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("103A").")/u";
		$replacement[$j] = "$2$3";//remove zwsp infront of consonents if consonent is folled by asat.
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1037").")?(".$this->unichr("103A").")/u";
		$replacement[$j] = "$2$3$4";//remove zwsp infront of consonents if consonent is folled by asat.
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1039").")([(".$this->unichr("200B").")])/u";
		$replacement[$j] = "$2$3";//remoze zwsp behind virama
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1031").$this->unichr("103C")."])?([".$this->unichr("200B")."])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")/u"; 
	
		$replacement[$j] = "$1$3$4$5".$this->unichr("200B");
	
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1031").$this->unichr("103C")."])?([".$this->unichr("200B")."])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1004").$this->unichr("103A").$this->unichr("1039").")?([".$this->unichr("1037")."])/u"; 
	
		$replacement[$j] = "$1$3$4$5".$this->unichr("200B");
	
		$j++;
		
		$pattern[$j]="/[".$this->unichr("200B")."]{2,}/u";
		$replacement[$j] = $this->unichr("200B");//two zwsp to one zwsp
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("0020").$this->unichr("103A").$this->unichr("1037").$this->unichr("104A").$this->unichr("104B")."])/u";
		$replacement[$j] = "$2";//remoze zwsp if there is space and vowel behind
		$j++;
		
		$txt=preg_replace($pattern, $replacement, $txt);
		
		return $txt;
	}
	function zwsp_mm3($txt)
	{
	
		$j=0;
		
				
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("102A")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("103F")."-".$this->unichr("1049")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("104C")."-".$this->unichr("104F")."])/u";
		$replacement[$j] = $this->unichr("200B")."$1";//added zwsp infront of all consonent.
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1038").")/u";
		$replacement[$j] = "$1".$this->unichr("200B");
		
		$j++;
		
		$pattern[$j]="/(".$this->unichr("1037").")/u";
		$replacement[$j] = "$1".$this->unichr("200B");
		
		$j++;
	
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("103A").")/u";
		$replacement[$j] = "$2$3";//remove zwsp infront of consonents if consonent is folled by asat.
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1037").")?(".$this->unichr("103A").")/u";
		$replacement[$j] = "$2$3$4$1";
		
		$j++;
		
		$pattern[$j]="/([".$this->unichr("1000")."-".$this->unichr("1021")."])?(".$this->unichr("1039").")([(".$this->unichr("200B").")])/u";
		$replacement[$j] = "$1$2";//remoze zwsp behind virama
		
		$j++;
		
		$pattern[$j]="/[".$this->unichr("200B")."]{2,}/u";
		$replacement[$j] = $this->unichr("200B");//two zwsp to one zwsp
		
		$j++;
		
		$pattern[$j]="/([(".$this->unichr("200B").")])?([".$this->unichr("0020").$this->unichr("103A").$this->unichr("1037").$this->unichr("104A").$this->unichr("104B")."])/u";
		$replacement[$j] = "$2";//remoze zwsp if there is space and vowel behind
		$j++;
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

$zwsp = new ZWSP();
?>
