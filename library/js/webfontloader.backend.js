// Load Webfonts
WebFontConfig = {
    google: {
        families: ['Lato:400', 'Signika:700']
    }
};

(function(d) {
   var wf = d.createElement('script'), s = d.scripts[0];
   wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js';
   s.parentNode.insertBefore(wf, s);
})(document);
