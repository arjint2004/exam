<div class="mainholder ">
<div class="usercontent ui-corner-all">
 <!-- OLD DATA -->
    <table cellspacing=20 cellpadding=10 style="width:100%">
        <tr>
            <td>
            <link href="<?=base_url();?>assets/css/exam.css" rel="stylesheet" type="text/css" />
            <!--<link href="//cdn6.f-cdn.com/build/css/skin/global.css?v=08ca2395923652d3623bd1444d2efffc&amp;m=2" rel="stylesheet" type="text/css" />-->
            <script type="text/javascript" src="<?=base_url();?>assets/js/exam.js"></script>
            <script type="text/javascript">
                    var EXAM_TIME_LEFT = '<?=$duration;?>';
                    var EXAM_REQUEST_ID = '<?=$examid;?>';
            </script>
        
            <div id="loading">
                <h1  style="font-size:1.2em">Tunggu sampai soal tampil...</h1>
            </div>
            <div id="submitting" style="display: none;">
                <h1 style="font-size:1.2em">Harap tunggu hasil ujian Anda sedang dikirim...</h1>
            </div>
            <div id="error-message" style="display: none;">
                <h1>Terjadi Error</h1>
                <p id="error-text"></p>
            </div>
            <div id="sub_title">
                <div id="exam-ui" class="exam_left">
                <div class="exam_content_area">
                <h1 id="exam-name"></h1>
                <h4>
                Pertanyaan  <span id="question-index"></span> / <span
                id="question-count"></span>
                </h4>
                <br>
                <form>
                <fieldset id="exam-question">
                <div id="question-text" style="margin-bottom:10px; "></div>
                <div><ul id="answers" class="unstyled" /></div>
                </fieldset>
                <br>
                <table class="no-border">
                <tbody>
                <tr>
                <td id="submit-answer"><input
                type="button"
                value="Jawab"
                id="record-answer-button"
                class="btn btn-primary" /></td>                  
                <td style="padding-left: 145px;"><input type="button"
                value="Lewati"
                id="skip-button" 
                class="btn"/></td>
                <td style="padding-left: 22px;" id="complete-exam"><input
                type="button"
                value="Selesai"
                id="finish-exam-button" 
                class="btn"/></td>
                </tr>
                </tbody>
                </table>
                </form>
                        <input id="question-id" name="question_id" value="" type="hidden" />
                    </div>
                </div>
            </div>     
            <div class="right">
                <div>
                    <b>Sisa Waktu:</b>
                    <form id="exam-timer">
                        <input value="" readonly="readonly"
                            name="time_left" id="exam-time-left"
                            style="font-size: 18px; width: 80px; background-color: #FFF; border-radius: 0px;" />
                    </form>
                </div>
                <div>
                    <p><b>Navigasi Soal:</b></p>
                    <div id="navigation-area">
                    </div>
                </div>
            </div></tr>
    </table> 
</div></div>