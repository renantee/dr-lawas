    /************************************************************
		Code 128 definitions
	************************************************************/

	/*
        Bar/Space Weight definitions.
		See: http://en.wikipedia.org/wiki/Code_128
	*/
    var code128BARS = [
	   212222,222122,222221,121223,121322,131222,122213,122312,132212,221213,221312,231212,
	   112232,122132,122231,113222,123122,123221,223211,221132,221231,213212,223112,312131,
	   311222,321122,321221,312212,322112,322211,212123,212321,232121,111323,131123,131321,
	   112313,132113,132311,211313,231113,231311,112133,112331,132131,113123,113321,133121,
	   313121,211331,231131,213113,213311,213131,311123,311321,331121,312113,312311,332111,
	   314111,221411,431111,111224,111422,121124,121421,141122,141221,112214,112412,122114,
	   122411,142112,142211,241211,221114,413111,241112,134111,111242,121142,121241,114212,
	   124112,124211,411212,421112,421211,212141,214121,412121,111143,111341,131141,114113,
	   114311,411113,411311,113141,114131,311141,411131,211412,211214,211232,23311120
    ];
    /*
	   128 control symbols
	*/
    var STARTA = 103;
    var STARTB = 104;
    var STARTC = 105;
    var CODEA  = 101;
    var CODEB  = 100;
    var CODEC  = 99;
    var STOP = 106; 
    var SPACE = 0;
    var AsciiOffset = 32;
	/*
		AusPost BI
	 */
	var BILLERID = '*2148';
	var C128_SYM_LEN   = 4; // INCLUDES (StartB, CodeC, Check, stop)
    var PBPAY_CODECDATA_LEN = 3; // INCLUDES ("148" of BI number '*2148')
    var PBPAY_CODEBDATA_LEN = 2; // INCLUDES ("*2" of BI number '*2148')
	
	/************************************************************
		Operation
	************************************************************/

    /*
        @desc Main function. Convert values to html formatted barcode image.
        
        @param code - The RPlus member account number.
        @return string. html tags with barcode image information. 
     */
    function generateRPlusBarCode(acct_num) {
	   return code128(postBillPayFormat(acct_num));
    }
	/*
		@desc AusPost specifics. Add Code 128 specific information. 
			  Format user data for Code128 and Auspost compliance. 

		@param acct_num. RPlus member ID.
		@return string. Code128 compliant code and data. 
	 */
    function postBillPayFormat(acct_num) { 
	   var arrAscii = [];		
	   var userDataLen = acct_num.length + (acct_num.length%2 ? 1 : 0)  // odd length string.
	   var CodeCDataLen = userDataLen + PBPAY_CODEBDATA_LEN + C128_SYM_LEN; 

	   // Insert first 4 symbols. Include (StartB, '*', BI idx 1 (2), CodeC   
	   arrAscii.push(STARTB, BILLERID.charCodeAt(0), BILLERID.charCodeAt(1), CODEC);			 
	   // add last 3 BI code.
	   var raw_data = BILLERID.slice(PBPAY_CODEBDATA_LEN) + acct_num;
   	   // add padding for compression bytes;
	   if ( raw_data.length%2 > 0) 
			raw_data += SPACE;	  
	   // compress UserData to CodeC values.
	   for(var stringCounter = 0 ; stringCounter < raw_data.length; stringCounter++) { 
            var codeCValue = raw_data.substr(stringCounter++, 2); 
            arrAscii.push(codeCValue); 
       }
       //alert(arrAscii);		   
       // Pad unused sections at end of user data to 0;
	   // data section is assumed to be same as the user data length.
	   // Since user data is compressed to half the Barcode user data 
	   // place holder, pad remaining bytes to 00.
	   // TODO: move to function code128().
	   var padLen = raw_data.length - userDataLen;
	   for(var padIdx = 0; padIdx <= padLen ; padIdx++) { 
			arrAscii.push(SPACE);
       }
       //alert(arrAscii);		   
	   return arrAscii;
    }
	/*
		@desc Checks for formatting errors
			  Computes checksum.     
			  Translate ascii to CodeB values if needed.

		@return string. Converted bar/space weight values.
	 */
    function code128(raw_data) {
	   var bars = [];
	   var barcodeType;
	   bars.add = function(nr) {
		   // symbol to bar/space weight values
	       var nrCode = code128BARS[nr];
		   // checksum.
	       this.check = this.length==0 ? nr : this.check + nr*this.length;
	       this.push( nrCode || format("UNDEFINED: %1->%2", nr, nrCode));
	   };
       // check symbol, translate if needed.
       var checkArrLen = raw_data.length - 2;
	   for(var i=0; i< checkArrLen; i++) {
	       var code = raw_data[i];
	       if ((code >= CODEC) && (code <= STOP)) { 
		      barcodeType = code; 
	       } else if (barcodeType==CODEC) {
		      code = parseInt(code);
	       } else {
		      code = fromType(barcodeType, code);
	       } 
	       if (isNaN(code) || code<SPACE || code>STOP) 
		      throw new Error(format("Invalid symbol (%1) at position %2 in '%3'.", code, i, bar_code));    
           bars.add(code);
	   }
	   bars.push(code128BARS[bars.check % 103], code128BARS[STOP]);
	   return bars;
    }
    /*
		@desc Symbol convert from Ascii to Code128.

		@param codeType. The code type A, B, or C.
		@param charCode. Ascii symbol.

		@return Code128 symbol.
	 */
    function fromType(codeType, charCode) {
	   var converted = -1;
	   switch (codeType)
	   {	
		case STARTA:
		case CODEA:
		  if (charCode>=0 && charCode<32) converted = charCode+64;
		  if (charCode>=32 && charCode<96) converted = charCode-32;
		  break;    
		case STARTB:
		case CODEB:
		  if (charCode>=32 && charCode<128) converted = charCode-32;
		  break;  
		case STARTC:
		case CODEC: 
		  converted = charCode;
		   break;
	   }
	   return converted;
    }  