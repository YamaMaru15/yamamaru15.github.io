'use strict';

{
    const title = document.getElementById('title');
    const text = document.getElementById('text');
    const save = document.getElementById('save');
    const clear = document.getElementById('clear');
    const id= document.getElementById('id');

    // localStrage内の値の判定title
    if (localStorage.getItem('title') === null) {
        title.value = '';
    } else {
        title.value = localStorage.getItem('title');
    };

    // localStrage内の値の判定memo   
    if (localStorage.getItem('memo') === null) {
        text.value = '';
    } else {
        text.value = localStorage.getItem('memo');
    };

    // 保存してない場合の動作
    window.addEventListener('beforeunload', (event) => {
        event.preventDefault();
        // Chomeの設定
        event.returnValue = '';
    });

    // 保存クリック動作
    save.addEventListener('click', () => {
        message.classList.add('appear');
        // 1秒後にappearクラスを削除
        setTimeout(() => {
            message.classList.remove('appear');
        },1000); 
        localStorage.setItem('title',title.value);
        localStorage.setItem('memo',text.value);
    });

    // 削除クリック動作
    clear.addEventListener('click', () => {
        if (confirm('本当に削除しますか？') === true){
            title.value = '';
            text.value = '';
            localStorage.removeItem('title');
            localStorage.removeItem('memo');
        }
    });
}