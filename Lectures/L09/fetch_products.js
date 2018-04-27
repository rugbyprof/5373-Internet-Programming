
grabProducts(0, 9,$('#candy-content'));

console.log("loaded!!")

function grabProducts(offset, size, $dom_ele) {

    $dom_ele.html("");

    offset = (typeof offset !== 'undefined') ? offset : 0;
    size = (typeof size !== 'undefined') ? size : 10;
    var route = "app.php/browse/offset/" + offset + "/size/" + size + "/category/all";

    $.get(route)
        .done(function (data) {
            data = data.data;

            for(var i=0;i<data.length;i++){
                $dom_ele.append(build_product_card(data[i]));
            }

        });
}

function build_product_card(data) {
    console.log(data);
    var img = data.image_path+'_small'+'.'+data.img_type;
    console.log(img)
    var short = data.description.substr(0,100)+"...";
    var html = '';
    html += '<div class="col-lg-4 col-md-6 mb-4">';
    html += ' <div class="card h-100">';
    html += '  <a href="#"><img class="card-img-top" src="'+img+'" alt=""></a>';
    html += '   <div class="card-body">';
    html += '    <h4 class="card-title">';
    html += '      <a href="#">'+data.name+'</a>';
    html += '    </h4>';
    html += '    <h5>$'+data.price+'</h5>';
    html += '    <p class="card-text">'+short+'</p>';
    html += '   </div>';
    html += '   <div class="card-footer">';
    html += '   <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>';
    html += '  </div>';
    html += ' </div>';
    html += '</div>';
    return html;
}

