<template>
  <div class="time-line-root">
    <transition-group class="time-line-ul" tag="ul" ref="ul">
      <li class="time-line-li" key="1">
        <div class="content-roll">
			<h3 class="titles">2020-12-15</h3>
			<p class="content">
				启动日期启动日期启动日期启动日期启动
				日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
			</p>
		</div>
      </li>
      <li class="time-line-li" key="2">
        <div class="content-roll">
			<h3 class="titles">启动日期</h3>
			<p class="content">
				启动日期启动日期启动日期启动日期启动
				日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
			</p>
		</div>
      </li>
      <li class="time-line-li" key="3">
        <div class="content-roll">
			<h3 class="titles">启动日期</h3>
			<p class="content">
				启动日期启动日期启动日期启动日期启动
				日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
			</p>
		</div>
      </li>
      <li class="time-line-li" key="4">
        <div class="content-roll">
			<h3 class="titles">启动日期</h3>
			<p class="content">
				启动日期启动日期启动日期启动日期启动
				日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
				启动日期启动日期启动日期启动日
				期启动日期启动日期启动日期启动日期启动日期
			</p>
		</div>
      </li>
    </transition-group>
  </div>
</template>
<script>
export default {
  created() {},
  mounted() {
    this.$refs.ul.$el.addEventListener("mouseover", (e) => {
      if (
        e.target.tagName.toLowerCase() === "li" ||
        e.target.tagName.toLowerCase() === "div"
      ) {
		  let div = null;
		  let divs = document.querySelectorAll('.content-roll');
		 if(e.target.tagName.toLowerCase() !== 'li' || e.target.tagName.toLowerCase() !== 'ul') {
			div = document.querySelector('.content-roll');
		 }else {
			 div = e.target;
		 }
        const OFFSETWIDTH =
          window.innerWidth || window.outerWidth || window.screen.width;
		let half = parseInt(OFFSETWIDTH / 2, 10);
		let _this = this;
        this.$refs.ul.$el.addEventListener("mousemove", function (el) {
          let divClassList = Array.from(div.classList);
		  let x = el.offsetX || el.x || el.pageX || el.layerX;
		  _this.iterationDiv(divs);
          if (x >= half) {
            // 判断div标签上面是否有左倾斜样式
            if (divClassList.indexOf("left-avtive")) {
              div.classList.remove("left-active");
			} 
			if (el.target.tagName.toLowerCase() === "li") {
                el.target.firstElementChild.classList.add("right-active");
              } else if (el.target.tagName.toLowerCase() === "div") {
                el.target.classList.add("right-active");
              }
          } else {
            // 判断div标签上面是否有右倾斜样式
            if (divClassList.indexOf("right-avtive")) {
              div.classList.remove("right-active");
			}
			if (el.target.tagName.toLowerCase() === "li") {
                el.target.firstElementChild.classList.add("left-active");
              } else if (el.target.tagName.toLowerCase() === "div") {
                el.target.classList.add("left-active");
              }
          }
        });
      }
    });
  },
  methods: {
	  iterationDiv(divs = []) {
		  for(let i = 0;i<divs.length;i++) {
			  if(divs[i].classList.contains('left-active')) {
				  divs[i].classList.remove('left-active');
			  }else {
				  divs[i].classList.remove('right-active');
			  }
		  }
	  }
  },
};
</script>
<style lang='scss' scoped>
.time-line-root {
  min-height: 100vh;
  .time-line-ul {
    overflow: hidden;
    padding: 5px 0;
    .time-line-li {
      min-height: 100vh;
      border-radius: 10px;
      overflow: hidden;
      position: relative;
      box-sizing: border-box;
	  padding-top: 2rem;
	  margin: 1rem 0;
	  background-color: #333;
	  color: #ccc;
      &:nth-child(2n + 1) {
        background-color: rgb(149, 165, 166);
        color: #fff;
      }
      &::after {
        content: "";
        width: 20px;
        height: 20px;
        background-color: #fff;
        position: absolute;
        border-radius: 50%;
        left: 50%;
        top: 0.3rem;
        transform: translateX(-50%);
      }
      .content-roll {
        height: inherit;
        border-top: 1px solid #000;
        transition: all 0.5s;
		text-align: center;
		border-radius: 5px;
		perspective: 1000px;
		.titles {
			transform-style: preserve-3d;
			width: 90%;
			margin: 0 auto;
			margin-top: -0.7rem;
			background-color: rgb(26,188,156);
			border-radius: 5px;
			box-shadow: 0 3px 5px #ccc;
			transform: rotateX(15deg);
		}
		.content {
			text-align: left;
			transform: scale(0.9);
		}
      }
      .left-active {
        transform: rotate(5deg);
      }
      .right-active {
        transform: rotate(-5deg);
      }
    }
  }
}
</style>