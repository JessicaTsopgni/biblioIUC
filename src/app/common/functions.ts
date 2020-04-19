import { Injectable } from '@angular/core';


declare var $:any;

@Injectable({
  providedIn: 'root'
})

export class Functions
{
    
    defaultContent = '';
    count_change = 0;

    constructor(){}
    readURL(input, target, size, width, height) {
        let current = this; //target = document.getElementById(target);
        if (this.count_change == 0)
            this.defaultContent = $(target).html();
        if (input.files && input.files[0]) {
            if (input.files[0].size <= (size * 1024)) {
                var reader = new FileReader();
                reader.onload = function (e: any) {
                    if (input.files[0].type.match('image/*')) {
                        var img = new Image();
                        img.onload = function () {
                            var pw = 0;
                            var ph = 0;
                            if (width != 0) {
                                pw = img.width / width;
                            }
                            if (height != 0) {
                                ph = img.height / height;
                            }
                            var p = pw > ph ? pw : ph;
                            if (p > 1) {
                                width = Math.floor(img.width / p);
                                height = Math.floor(img.height / p);
                            }
                            else {
                                width = img.width;
                                height = img.height;
                            }
                            $(target).html('<img src = "' + e.target.result + '" class="img-fluid rounded" style = " width:' + width + 'px; height :' + height + 'px" />');
                            //$(target).html('<img src = "' + e.target.result + '" class="img-fluid" />');
                            current.count_change++;
                        };
                        var _URL = null;
                        if (window.URL)
                            _URL = window.URL;
                        // if (window.webkitURL)
                        //     _URL = window.webkitURL;
                        img.src = _URL.createObjectURL(input.files[0]);
                    }
                    else {
                        $(target).html(current.defaultContent);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
            else {
                input.value = '';
                alert('Allowed file size exceeded. (Max. ' + size + ' ko)');
            }
        }
        else {
            $(target).html(this.defaultContent);
        }
    }
    sleep(milliseconds) {
        const date = Date.now();
        let currentDate = null;
        do {
          currentDate = Date.now();
        } while (currentDate - date < milliseconds);
      }

      get_time_diff_sec(start, end){ 
        let time_diff = (end - start) / 1000;
        return time_diff < 1 ? "a l'instant" : Math.floor(time_diff) + " sec."
      }
}