
    <table align="center" border="0" cellspacing="0" cellpadding="0" style="width: 960px; height: 60px;">
        <tr>
            <td style="text-align: center; font-size: 26px;">
            Sldieshow Transition Viewer
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td width="850" height="20"></td>
        </tr>
    </table>
    
    <!-- Slideshow Transition Controller Form Begine -->
    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#EEEEEE" align="center" style="color:#000;width:700px;background-color:silver">
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
    <!-- Slideshow Transition Controller Form End -->
    <table cellpadding="0" cellspacing="0" border="0" align="center">
        <tr>
            <td width="850" height="50"></td>
        </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" width="600" height="300" align="center" bgcolor="#EEEEEE">
        <tr>
            <td>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
                <div style="position: relative; width: 600px; height: 300px;" id="slider1_container">

                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity:.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                    </div>

                    <div u="slides" style="cursor: move; position: absolute; width: 600px; height: 300px;top:0px;left:0px;overflow:hidden;">
                        <!-- Slide -->
                        <div>
                            <img u="image" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/landscape/01.jpg">
                        </div>
                        <!-- Slide -->
                        <div>
                            <img u="image" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/landscape/02.jpg">
                        </div>
                        <!-- Slide -->
                        <div>
                            <img u="image" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/landscape/04.jpg">
                        </div>
                        <!-- Slide -->
                        <div>
                            <img u="image" src="<?php echo JSSOR_SL_PLUGIN_URL ?>/assets/images/landscape/05.jpg">
                        </div>
                    </div>
                </div>
                <!-- Jssor Slider End -->
            </td>
        </tr>
    </table>
    <script>
        slideshow_transition_controller_starter("slider1_container");
    </script>

