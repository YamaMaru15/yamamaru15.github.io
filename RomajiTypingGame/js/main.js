'use strict';

{
    // 単語のランダム表示
    function setWord() {
        // 「~単語個数」でランダム数値生成
        //単語の位置からその単語を削除 splice,配列で値を返す
        word = words.splice(Math.floor(Math.random() * words.length),1)[0]; 
        target.textContent = word; 
        //次の単語に移るので0に戻す
        loc = 0; 
    }
    
    //各難易度ボタンを消し、スタートボタン出現
    function btnCtl() {
        easy.classList.add('btn-none');
        medium.classList.add('btn-none');
        hard.classList.add('btn-none');
        startbtn.classList.remove('btn-none');
        restart.classList.remove('btn-none');
        flash.textContent = '↓ click to start! ↓';
    }

    //アニメーション
    $(function(){
        setInterval(function(){
            $('#flash').fadeOut(700,function(){$(this).fadeIn(700)});
        },100);
    });

    //難易度ごとの配列
    const easyWords = [
        ['sweet', 'sister', 'sadistic','surprise','smile'],
        ['mikan', 'tokei', 'aozora','okane','hana'],
        ['service', 'happy', 'blue','rainbow','love'],
    ];
    const mediumWords = [
        ['thank you','starry sky','warm coffee','beautiful sunset','cute cat'],
        ['sayounara','sakurasaku','happi-endo','kurarinetto','sentakuki'],
        ['happy memories','healthy body','free time','stellar stellar','green forest'],
    ];
        const hardWords = [
        ['dreams come true','last of us','music fills the air','stars twinkle brightly','i\'ll be back'],
        ['itumitemo kireidane..','kutiku siteyaru!','nigetyadameda nigetyadameda','onikuga ippai tabetai','kabaha zisoku30kirode hasireru'],
        ['otousan okaasan oziisan','ge-mu sitakute yofukasi','sinyaha ra-menga tabetakunaru','kinou nanzini netakke??','fudangiha pajamadesu'],
    ];
    
    let words;
    let randomWords = [];
    let level;
    let loc = 0; 
    let word;
    let startTime; //クリック開始時刻
    let randomIndex;
    const start = document.getElementById('start');
    const startbtn = document.getElementById('startbtn');
    const target = document.getElementById('target');
    start.textContent = 'Typing Game';
    const flash = document.getElementById('flash');
    flash.textContent = '↓ choose your level! ↓';
    const restart = document.getElementById('restart');
    const easy = document.getElementById('easy');
    const medium = document.getElementById('medium');
    const hard = document.getElementById('hard');

    //難易度easyボタン
    easy.addEventListener('click' ,() => {
        level = 'easy';
        btnCtl();
        start.textContent = 'select easy !';
        startbtn.classList.add('btn-outline-primary');
    });

    //難易度mediumボタン
    medium.addEventListener('click' ,() => {
        level = 'medium';
        btnCtl();
        start.textContent = 'select medium !!';
        startbtn.classList.add('btn-outline-success');
        alert('空白も1文字として入力してください！');
    });

    //難易度hardボタン
    hard.addEventListener('click' ,() => {
        level = 'hard';
        btnCtl();
        start.textContent = 'select hard !!!';
        startbtn.classList.add('btn-outline-danger');
        alert('空白も1文字として入力してください！');
    });

    //startボタン
    startbtn.addEventListener('click' ,() => {
        startTime = Date.now();
        
        //ランダムにタイピング単語を生成、格納
        if (level === 'easy') {
            randomWords = easyWords;
        } else if (level === 'medium') {
            randomWords = mediumWords;
        } else if (level === 'hard') {
            randomWords = hardWords;
        }
        randomIndex = Math.floor(Math.random() * randomWords.length);
        words = randomWords[randomIndex];
        setWord();
        start.classList.add('btn-none');
        startbtn.classList.add('btn-none');
        $('#flash').remove();
    });

    //ワード入力判定
    document.addEventListener('keydown', e => {
        // 誤入力時処理、早期リターン
        if (e.key !== word[loc]) { 
            return;
        } 
        loc++;

        //表示文字
        //1:_ed
        //2:__d
        //3:___
        target.textContent = '_'.repeat(loc) + word.substring(loc);
        
        // 正入力処理、次ワードセット
        if(loc === word.length) {
            //全ワード入力後処理
            if (words.length === 0) { 
                const elapsedTime = ((Date.now() - startTime) / 1000).toFixed(2); //クリック時間-終わった時間秒単位に直す
                const result = document.getElementById('result');
                result.textContent = `Finished!!  ${elapsedTime}   seconds!`;
                restart.classList.add('btn-lg');
                return;
            }
            setWord();
        }
    });

    // restartボタン動作
    restart.addEventListener('click',() => {
        window.location.reload();
    });
}