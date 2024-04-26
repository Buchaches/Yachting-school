<div class="mask">
    <div class="spinner-eclipse">
        <div class="animation">
            <div></div>
        </div>
    </div>
</div>

<style>
.mask{
    width: 100%;
    height: 100%;
    background-color: #1a1a1a;
    position: fixed;
    top: 0;
    z-index: 99999;
    transition: 0.6s;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hide{
    opacity: 0;
}

@keyframes animation {
  0% { transform: rotate(0deg) }
  50% { transform: rotate(180deg) }
  100% { transform: rotate(360deg) }
}

.animation div {
  position: absolute;
  animation: animation 1s linear infinite;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 50%;
  box-shadow: 0 8px 0 0 #4e88b8;
  transform-origin: 80px 84px;
}

.spinner-eclipse {
  width: 200px;
  height: 200px;
  display: inline-block;
  overflow: hidden;
  background: rgba(255, 255, 255, 0);
}

.animation {
  width: 100%;
  height: 100%;
  position: relative;
  transform: translateZ(0) scale(1);
  backface-visibility: hidden;
  transform-origin: 0 0;
}

.animation div {
     box-sizing: content-box; 
}
</style>

<script>
let mask = document.querySelector('.mask');
window.addEventListener('load', () => {
    mask.classList.add('hide');
    setTimeout(() => {
        mask.remove();
    }, 600);
});
</script>