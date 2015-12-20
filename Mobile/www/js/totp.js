TOTP = function() {

  var dec2hex = function(s) 
  {
    return (s < 15.5 ? "0" : "") + Math.round(s).toString(16);
  };

  var hexTodec = function(s) 
  {
    return parseInt(s, 16);
  };

  var leftpad = function(s, l, p) 
  {
    if(l + 1 >= s.length) {
      s = Array(l + 1 - s.length).join(p) + s;
    }
    return s;
  };
  
  var getTimeStamp = function()
  {
      var time = leftpad(dec2hex(Math.floor(Math.round(new Date().getTime() / 1000.0)/ 30)), 16, "0");
      return (time);
  };

  var base32Tohex = function(base32) 
  {
    var base32chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
    var bits = "";
    var hex = "";

    for(var i = 0; i < base32.length; i++) {
      var val = base32chars.indexOf(base32.charAt(i).toUpperCase());
      bits += leftpad(val.toString(2), 5, '0');
    }

    for(var i = 0; i + 4 <= bits.length; i+=4) {
      var chunk = bits.substr(i, 4);
      hex = hex + parseInt(chunk, 2).toString(16) ;
    }
    return hex;
  };

  this.valueTOTP = function(key) 
  {
    try {
      var time = getTimeStamp();
      var hmacObj = new jsSHA(time, "HEX");
      var hmac = hmacObj.getHMAC(base32Tohex(key), "HEX", "SHA-1", "HEX");
      var offset = hexTodec(hmac.substring(hmac.length - 1));
      var totp = (hexTodec(hmac.substr(offset * 2, 8)) & hexTodec("7fffffff")) + "";
      totp = (totp).substr(totp.length - 6, 6);
    } catch (error) {
      throw error;
    }
    return totp;
  };

}
