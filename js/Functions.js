function upload(imgID,progressID,form)
{
  document.getElementById(progressID).style['width'] = '0%';
  smartObject =
			{
				html:function(code)
				{
          $info = JSON.parse(code);
          $img = document.getElementById(imgID);
          $img.src = $info.url;
          $img.alt = $info.name;
          $img.style['display'] = 'block';
          document.getElementById('image_input').value = $info.url;
          $img.parentNode.getElementsByTagName('span')[0].remove();
				}
				,
				error:function(code)
				{

				}
				,
				progress:function(num)
				{
					document.getElementById(progressID).style['width'] = num+'%';
				}
				,
				ajaxError:function()
				{
					alert("هناك خطأ عند محاولة الاتصال بالسيرفر !");
				}
			}

	request = new SmartAjax(smartObject);
	request.upload("upload",form);
}


function comment(form)
{
  smartObject = {
    html:function(code)
    {
      result = JSON.parse(code);
      // the code retrived
      div = document.createElement("div");
      div.setAttribute("class","col-lg-12 article-comment");
      div.innerHTML = "";

      if(result.anonymous == 0)
        div.innerHTML += '<h5> * علق <b>'+result.writer+'</b></h5>';
      else
        div.innerHTML += '<h5> * علق <b>مجهول</b></h5>';

      div.innerHTML += '<h6>'+result.content+'</h6>';

      document.getElementById("comments-section").appendChild(div);
      document.getElementById("comment_content").value = "";
      document.getElementById("comment_anonymous").checked = false;
    },
    error:function(code)
    {

    },
    ajaxError:function()
    {
      alert("هناك خطأ عند محاولة الاتصال بالسيرفر !");
    }
  };

  request = new SmartAjax(smartObject);
  $data = "content="+document.getElementById("comment_content").value+"&anonymous="+(document.getElementById("comment_anonymous").checked ? 1 : 0);
  $data += "&id="+form.id;
  request.post(form.action,$data);
}

function uprate($id,elem)
{
  elem.disabled = true;
  smartObject = {
    html:function(code)
    {
      elem.getElementsByTagName("span")[0].innerHTML = code;
    },
    error:function(code)
    {

    },
    ajaxError:function()
    {
      alert("هناك خطأ عند محاولة الاتصال بالسيرفر !");
    }
  };
  request = new SmartAjax(smartObject);
  request.get("uprate/"+$id);
}

function downrate($id,elem)
{
  elem.disabled = true;
  smartObject = {
    html:function(code)
    {
      elem.getElementsByTagName("span")[0].innerHTML = code;
    },
    error:function(code)
    {

    },
    ajaxError:function()
    {
      alert("هناك خطأ عند محاولة الاتصال بالسيرفر !");
    }
  };
  request = new SmartAjax(smartObject);
  request.get("downrate/"+$id);
}
