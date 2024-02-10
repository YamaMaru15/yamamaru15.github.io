'use strict';

{
    function setWord() {
        word = words.splice(Math.floor(Math.random() * words.length),1)[0]; //単語の位置からその単語を削除　splice,配列で値を返す
        target.textContent = word; 
        loc = 0; //次の単語に移るので0に戻す
    }

    const words = [
        'red',
        'blue',
        'pink',
        'yellow',
        'green',
    ];
    let word;
    let loc = 0; 
    let startTime; //クリック開始時刻
    let isPlaying = false;
    const target = document.getElementById('target');

    document.addEventListener('click' ,() => {
        if (isPlaying === true) { //クリックしてプレイしていた場合、クリックの動作を無効化
            return;
        }
        isPlaying = true;
        startTime = Date.now();
        setWord();
    });

    document.addEventListener('keydown', e => {
        if (e.key !== word[loc]) { //不正解の時 早期リターン
            return;
        } 
        loc++;

        //正解時の文字変換
        //1:_ed
        //2:__d
        //3:___
        target.textContent = '_'.repeat(loc) + word.substring(loc);
        
        if(loc === word.length) {
            if (words.length === 0) { //spliceですべて削除したとき
                const elapsedTime = ((Date.now() - startTime) / 1000).toFixed(2); //クリック時間-終わった時間秒単位に直す
                const result = document.getElementById('result');
                result.textContent = `Finished!!'${elapsedTime} seconds!`;
                return;
            }
            setWord();
        }
    });
}