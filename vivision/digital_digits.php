<!--https://codepen.io/ycpand/pen/Ejzdqy -->

<style>
body {
  margin: 0;
  padding: 0;
  background: #000;
}

.display {
  width: 75%;
  margin: 3% auto;
}

.digits div {
  position: relative;
  width: 0px;
  height: 80px;
  display: inline-block;
  margin: 0 0.8em;
}

.digits .d1 {
  position: absolute;
  display: block;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d1:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  left: -5px;
  border-width: 0 5px 5px 0;
  border-color: transparent #fff transparent transparent;
}

.digits .d1:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  right: -5px;
  border-width: 5px 5px 0 0;
  border-color: #fff transparent transparent transparent;
}

.digits .d2 {
  left: -7.5px;
  top: 7.5px;
  position: absolute;
  display: block;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d2:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  top: -5px;
  border-width: 5px 0 0 5px;
  border-color: transparent transparent transparent #fff;
}

.digits .d2:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  bottom: -5px;
  border-width: 5px 5px 0 0;
  border-color: #fff transparent transparent transparent;
}

.digits .d3 {
  left: 7.5px;
  top: 7.5px;
  position: absolute;
  display: block;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d3:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  top: -5px;
  border-width: 0 0 5px 5px;
  border-color: transparent transparent #fff transparent;
}

.digits .d3:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  bottom: -5px;
  border-width: 0 5px 5px 0;
  border-color: transparent #fff transparent transparent;
}

.digits .d4 {
  left: -7.5px;
  top: 25px;
  position: absolute;
  display: block;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d4:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  top: -5px;
  border-width: 5px 0 0 5px;
  border-color: transparent transparent transparent #fff;
}

.digits .d4:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  bottom: -5px;
  border-width: 5px 5px 0 0;
  border-color: #fff transparent transparent transparent;
}

.digits .d5 {
  left: 7.5px;
  top: 25px;
  position: absolute;
  display: block;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d5:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  top: -5px;
  border-width: 0 0 5px 5px;
  border-color: transparent transparent #fff transparent;
}

.digits .d5:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  bottom: -5px;
  border-width: 0 5px 5px 0;
  border-color: transparent #fff transparent transparent;
}

.digits .d6 {
  position: absolute;
  display: block;
  top: 16.25px;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d6:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  left: -5px;
  border-width: 2.5px 5px 2.5px 0;
  border-color: transparent #fff transparent transparent;
}

.digits .d6:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  right: -5px;
  border-width: 2.5px 0 2.5px 5px;
  border-color: transparent transparent transparent #fff;
}

.digits .d7 {
  position: absolute;
  display: block;
  top: 32.5px;
  width: 5px;
  height: 5px;
  background: #fff;
}

.digits .d7:before {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  left: -5px;
  border-width: 0 0 5px 5px;
  border-color: transparent transparent #fff transparent;
}

.digits .d7:after {
  content: " ";
  position: absolute;
  display: block;
  width: 0;
  height: 0;
  border-style: solid;
  right: -5px;
  border-width: 5px 0 0 5px;
  border-color: transparent transparent transparent #fff;
}

/* 0 */
.digits div.zero .d6 {
  visibility: hidden;
}

/* 1 */
.digits div.one .d1, .digits div.one .d2, .digits div.one .d4, .digits div.one .d6, .digits div.one .d7 {
  visibility: hidden;
}

/* 2 */
.digits div.two .d2, .digits div.two .d5 {
  visibility: hidden;
}

/* 3 */
.digits div.three .d2, .digits div.three .d4 {
  visibility: hidden;
}

/* 4 */
.digits div.four .d1, .digits div.four .d4, .digits div.four .d7 {
  visibility: hidden;
}

/* 5 */
.digits div.five .d3, .digits div.five .d4 {
  visibility: hidden;
}

/* 6 */
.digits div.six .d1, .digits div.six .d3 {
  visibility: hidden;
}

/* 7 */
.digits div.seven .d2, .digits div.seven .d4, .digits div.seven .d6, .digits div.seven .d7 {
  visibility: hidden;
}

/* 8 */
/* 9 */
.digits div.nine .d4, .digits div.nine .d7 {
  visibility: hidden;
}
</style>


<div class="display">
  <div class="digits">
    <div class="zero" style="width:20px; height:50px; overflow:hidden; ">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
    <div class="one">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
    <div class="two">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
    <div class="three">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
    <div class="four">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
    <div class="five">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
   <div class="six">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
   <div class="seven">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
   <div class="eight">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>
   <div class="nine">
      <span class="d1"></span>
      <span class="d2"></span>
      <span class="d3"></span>
      <span class="d4"></span>
      <span class="d5"></span>
      <span class="d6"></span>
      <span class="d7"></span>
    </div>        
  </div>
</div>