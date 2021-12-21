window.onload = function (){
    var fs=document.getElementById('fs');
    var defen=document.getElementById('defen');
    var canvas = document.getElementById("viewport");
    var context = canvas.getContext("2d");

    var lastframe = 0;
    var framecount = 0;
    var fpstime = 0;
    var fps = 0;

    var level = {
        x : 80,
        y : 48,
        width: canvas.width - 160,
        height: canvas.height - 96,
        wallsize: 16
    };

    var ball = {
        x: 0,
        y: 0,
        width: 35,
        height: 35,
        xdir: 0,
        ydir: 0,
        speed: 0
    }

    // 变量
    var score = 0;              // 分数
    var blocked = false;        // 底壁活跃
    var blockedtime = 0;        // 隔离墙活动多久了
    var blockedlength = 0.1;    // 墙将被激活多久
    var blockcooldown = 1;      // 墙激活之间的等待时间
    var gameover = true;        // 游戏结束
    var gameovertime = 0;       // 我们玩完多久了
    var gameoverdelay = 1;      // 比赛结束后的等待时间

    function init (){
        
        canvas.addEventListener("mousedown",onMouseDown);

        newgame();//开始新游戏

        main(0);//进入主循环
    }

    function newgame (){
        ball.x = level.x + (level.width - ball.width)/2;
        ball.y = level.y + level.height - ball.height;
        ball.speed = 500;

        ball.xdir = 0.4 + (Math.random())/2;
        ball.ydir = -1;

        if(Math.random()<0.5){
            ball.xdir = -1;
        }

        //使方向向量的长度正好等于1，以方便计算
        var dirlen = Math.sqrt(ball.xdir*ball.xdir+ball.ydir*ball.ydir);//计算向量长度
        ball.xdir = ball.xdir/dirlen;
        ball.ydir = ball.ydir/dirlen;

        score = 0;

        blocked = false;
        blockedtime = blockcooldown;
        gameover = true;
        gameovertime = 0;
    }

    function main(tframe){
        window.requestAnimationFrame(main);//执行并通过回调main函数更新动画，正常情况下每秒60次
        update(tframe);//更新和渲染游戏
        render();
    }

    //更新游戏状态，计算已经过去了的时间
    function update(tframe){
        var dt = (tframe - lastframe)/1000;//根据帧数计算时间
        lastframe = tframe;
        //更新帧数计数器
        updatefps(dt);
        //判断游戏运行状态
        if(!gameover){
            updategame(dt);
        }
        else{
            gameovertime += dt;
        }
    }

    function updategame(dt){
        ball.x += dt*ball.speed*ball.xdir;
        ball.y += dt*ball.speed*ball.ydir;

        blockedtime += dt;
        if(blocked){
            if(blockedtime>blockedlength){
                blocked = false;
            }
        }

        if(ball.x <= level.x){
            //左碰撞
            ball.xdir *= -1;
            ball.x = level.x;
        }
        else if(ball.x + ball.width >= level.x + level.width){
            //右碰撞
            ball.xdir *= -1;
            ball.x = level.x +level.width - ball.width;
        }

        if(ball.y <= level.y){
            //上碰撞
            ball.ydir *= -1;
            ball.y = level.y;
        }

        // 检查球是否与底壁碰撞
        // 只有在球移动到底部时才能这样做
        if (blocked && ball.ydir > 0 &&
            rectIntersection(ball.x, ball.y, ball.width, ball.height,
                             level.x, level.y+level.height, level.width,
                             level.wallsize) && ball.ydir > 0){
            ball.ydir *= -1;
            score += 1;
            ball.speed *= 1.05;
        }
        else if(ball.ydir>0 && ball.y > level.y+level.height+level.wallsize){
            ball.speed=0;
            gameover = true;
            if(score > 0){
                fs.value=score;
                defen.innerHTML='你的分数: '+score;
                //！在这里获取分数！!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                // alert("你的分数是："+score);//这一行可删除
            }
        }
    }
    
    // 检查是否有直角交点
    function rectIntersection(x1, y1, w1, h1, x2, y2, w2, h2) {
        if (x1 <= x2 + w2 && x1 + w1 >= x2 &&
            y1 <= y2 + h2 && y1 + h1 >= y2) {
            
            return true;
        }
        
        return false;
    }

    //计算帧数
    function updatefps(dt){
        if(fpstime > 0.25){
            fps = Math.round(framecount / fpstime);//round对数字四舍五入
            fpstime = 0;
            framecount = 0;
        }
        fpstime += dt;
        framecount++;
    }

    // 渲染游戏
    function render() {
        // 画背景
        context.fillStyle = "#577ddb";
        context.fillRect(0, 0, canvas.width, canvas.height);
        
        // 画壁
        context.fillStyle = "#ffffff";
        context.fillRect(level.x-level.wallsize, level.y-level.wallsize, level.wallsize,
                         level.height+2*level.wallsize); // 左
        context.fillRect(level.x+level.width, level.y-level.wallsize, level.wallsize,
                         level.height+2*level.wallsize); // 右
        context.fillRect(level.x, level.y-level.wallsize, level.width, level.wallsize); // 上
        
        // 如果关闭，拉底壁
        if (blocked) {
            context.fillRect(level.x, level.y+level.height, level.width, level.wallsize);
        }
        
        // 在关卡内取得分数
        context.fillStyle = "rgba(255, 255, 255, 0.7)";
        context.font = "240px Verdana";
        drawCenterText(score, level.x, level.y+level.height-150, level.width);
        
        // 画出球
        var centerx = ball.x + ball.width/2;
        var centery = ball.y + ball.height/2;
        context.beginPath();
        context.arc(centerx, centery, ball.width/2-3, 0, 2*Math.PI, false);
        context.fillStyle = "#000000";
        context.fill();
        context.lineWidth = 5;
        context.strokeStyle = "#ffffff";
        context.stroke();
        
        // 游戏结束
        if (gameover) {
            context.fillStyle = "rgba(0, 0, 0, 0.5)";
            context.fillRect(0, 0, canvas.width, canvas.height);
            
            context.fillStyle = "#ffffff";
            context.font = "24px Verdana";
            drawCenterText("Click to start", 0, canvas.height/2, canvas.width);
            
        }
    }

    // 绘制居中文本
    function drawCenterText(text, x, y, width) {
        var textdim = context.measureText(text);
        context.fillText(text, x + (width-textdim.width)/2, y);
    }
    
    // 鼠标事件处理程序
    function onMouseDown(e) {
        // 获取鼠标位置
        var pos = getMousePos(canvas, e);
        
        // 开始一个新游戏
        if (gameover && gameovertime > gameoverdelay) {
            newgame();
            gameover = false;
        }
        
        // 显示墙
        if (!gameover && blockedtime >= blockcooldown) {
            blockedtime = 0;
            blocked = true;
        }
    }
    
    // 获取鼠标位置
    function getMousePos(canvas, e) {
        var rect = canvas.getBoundingClientRect();//获取画布相对于视窗的位置集合，集合中有top, right, bottom, left等属性。
        return {
            x: Math.round((e.clientX - rect.left)/(rect.right - rect.left)*canvas.width),
            y: Math.round((e.clientY - rect.top)/(rect.bottom - rect.top)*canvas.height)
        };
    }
    
    // 调用init来启动游戏
    init();
}