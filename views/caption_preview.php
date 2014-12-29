    <style> 
        .captionOrange, .captionBlack, .captionBlock
        {
            color: #fff;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            filter: inherit;
        }
        .captionOrange
        {
            background: #EB5100;
            background-color: rgba(235, 81, 0, 0.6);
        }
    </style>
    <table align="center" border="0" cellspacing="0" cellpadding="0" style="width: 960px; height: 60px;">
        <tr>
            <td style="text-align: center; font-size: 26px;">
            Caption Transition Viewer
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td width="850" height="20"></td>
        </tr>
    </table>

    <!-- Caption Transition Controller Form Begine -->
    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEEE" align="center" style="color:#000;background-color:silver;">
        <tr>
            <td width="10">
            </td>
            <td width="110">
                <b>&nbsp; Select Transition</b>
            </td>
            <td width="320" height="40">
                <select name="ssTransition" id="ssTransition" style="width: 300px">
                    <option value="">
                </select>
            </td>
            <td width="490">
                <input type="button" value="Play" id="sButtonPlay" style="width: 110px" name="sButtonPlay" disabled="disabled">
            </td>
            <td width="30">
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEEE" align="center" style="color:#000; background-color:silver;display:none;">
        <tr>
            <td width="10" height="40">
            </td>
            <td width="110">
                <b>&nbsp; Transition Code</b>
            </td>
            <td width="840" valign=center>
                <input id="stTransition" style="width: 833px; height: 25px;" type="text" name="stTransition">
            </td>
        </tr>
    </table>
    <!-- Caption Transition Controller Form End -->

    <table cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td width="850" height="50">
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="0" cellspacing="0" width="600" height="300" align="center" bgcolor="#EEEEEE">
        <tr>
            <td>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
                <div style="position: relative; width: 960px; height: 380px; overflow: hidden;" id="slider1_container">
                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: inherit; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                    </div>

                    <div u="slides" style="cursor: move; position: absolute; width: 960px; height: 380px;left:0px;top:0px; overflow: hidden;">
                        <!-- Slide -->
                        <div>
                            <img u="image" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/home/01.jpg">
                            <img u="caption" t="0" style="position:absolute;left:200px;top:60px;width:80px;height:80px;" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/icon-slider-12-jquery.png">
                            <div u=caption t="0" d=-200 class="captionOrange"  style="position:absolute; left:350px; top: 85px; width:500px; height:30px;"> 
                                Jssor responsive touch swipe javascript image slider
                            </div> 
                            <div u=caption t="0" d=-200 class="captionOrange"  style="position:absolute; left:110px; top: 265px; width:500px; height:30px;"> 
                                Best Performance Slider, Most Scalable Slider
                            </div> 
                            <img u="caption" t="0" d=-200 style="position:absolute;left:680px;top:240px;width:80px;height:80px;" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/icon-slider-12-jquery.png">
                        </div>
                        <!-- Slide -->
                        <div>
                            <img u="image" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/home/02.jpg">
                            <img u="caption" t="0" style="position:absolute;left:200px;top:60px;width:80px;height:80px;" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/icon-slider-12-jquery.png">
                            <div u=caption t="0" d=-200 class="captionOrange"  style="position:absolute; left:350px; top: 85px; width:500px; height:30px;"> 
                                Jssor responsive touch swipe javascript image slider
                            </div> 
                            <div u=caption t="0" d=-200 class="captionOrange"  style="position:absolute; left:110px; top: 265px; width:500px; height:30px;"> 
                                Best Performance Slider, Most Scalable Slider
                            </div> 
                            <img u="caption" t="0" d=-200 style="position:absolute;left:680px;top:240px;width:80px;height:80px;" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/icon-slider-12-jquery.png">
                        </div>
                    </div>
                </div>
                <!-- Jssor Slider End -->
            </td>
        </tr>
    </table>
    <script>
        caption_transition_controller_starter("slider1_container");
    </script>

