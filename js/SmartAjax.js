/*
	SmartAjax Version 1.0.0
*/
function SmartAjax(smartObject)
{
	/*
		Submit a form
	*/
	this.form = function(form)
	{
		request = getRequest(form);
		success = this.success;
		// check type
		if(request.method.toLowerCase().endsWith("get"))
		{
			this.get((request.url+"?"+request.body));
			return;
		}

		$.ajax({
			  type: "POST",
			  url:request.url,
			  data:request.body,
				enctype: 'multipart/form-data',
			  success: success,
			  error:error
			});
	}


	/*
		Get Request Using Ajax
	*/
	this.get = function(url)
	{
		success = this.success;
		$.ajax({
			  type: "GET",
			  url:url,
			  success: success,
			  error:error
			});
	}

	/*
		Post Request using Ajax
	*/
	this.post = function(url,data)
	{
		success = this.success;
		$.ajax({
			  type: "POST",
			  url:url,
			  data:data,
			  success: success,
			  error:error
			});
	}

	/*
		Upload Single or multiple files
	*/
	this.upload = function(url,elem)
	{
		request = {};
		request.formData = new FormData();
		name = elem.getAttribute("name");

		// loop through files
		for(i=0,n=elem.files.length;i<n;i++)
		{
			request.formData.append(name, elem.files[i]);
		}

		// send Ajax
		success = this.success;
		$.ajax({
			 xhr: function() {
		        var xhr = new window.XMLHttpRequest();
		        xhr.upload.addEventListener("progress", function(evt) {
		            if (evt.lengthComputable) {
		                var percentComplete = evt.loaded / evt.total;
		                progress(parseInt(percentComplete*100));
		            }
		       }, false);
		       return xhr;},
            url: url,
            type: "POST",
            data: request.formData,
            processData: false,
            contentType: false,
            success: success,
            error:error
             });

	}
	/*
		Fired Once Sucess
	*/
	this.success = function(result)
	{
		// We will conver result to html and JS
		obj = JSON.parse(result);
		html(obj.html);
		htmlError(obj.error);
		eval(obj.js);
	}

	/*
		Invoke html
	*/
	html = function(htmlcode)
	{
		if(!(smartObject.html === undefined))
			smartObject.html(htmlcode);
	}
	/*
		Invoke Error
	*/
	error = function()
	{
		if(!(smartObject.ajaxError === undefined))
			smartObject.ajaxError();
	}
	/*
		Invoke Error From server
	*/
	htmlError = function()
	{
		if(!(smartObject.error === undefined))
			smartObject.error();
	}
	/*
		Invoke Progress
	*/
	progress = function(num)
	{
		if(!(smartObject.progress === undefined))
			smartObject.progress(num);
	}
	/*
		Helper functions
		it will transform the form into suitable body content
	*/
	getRequest = function(form)
	{
		request = {};
		request.url = getAjaxUrl(form.getAttribute("url"));
		request.method = form.method;
		request.body = "";

		// getting inputs
		data = form.getElementsByTagName("input");
		for(i=0,n=data.length;i<n;i++)
		{
			if(data[i].getAttribute("type")=="checkbox")
			{
				if((i+1) != n)
					request.body += data[i].getAttribute("name")+"="+(data[i].checked ? 1 : 0)+"&";
				else
					request.body += data[i].getAttribute("name")+"="+(data[i].checked ? 1 : 0);
			}
			else
			{
				if((i+1) != n)
					request.body += data[i].getAttribute("name")+"="+data[i].value+"&";
				else
					request.body += data[i].getAttribute("name")+"="+data[i].value;

			}
		}



		// getting textareas
		data = form.getElementsByTagName("textarea");
		if(data.length > 0 && n > 0)
			request.body += "&";

		if(data.length != 0)
		{
				for(i=0,n=data.length;i<n;i++)
				{
					if(data[i].getAttribute("id") == "editor")
					{
						if((i+1) != n)
							request.body += data[i].getAttribute("name")+"="+encodeURIComponent(CKEDITOR.instances.editor.getData())+"&";
						else
							request.body += data[i].getAttribute("name")+"="+encodeURIComponent(CKEDITOR.instances.editor.getData());
					}
					else
					{
						if((i+1) != n)
							request.body += data[i].getAttribute("name")+"="+data[i].value+"&";
						else
							request.body += data[i].getAttribute("name")+"="+data[i].value;
					}

				}
		}

		// getting select options
		data = form.getElementsByTagName("select");
		if(data.length > 0 && n > 0)
			request.body += "&";
		for(i=0,n=data.length;i<n;i++)
		{
			if((i+1) != n)
				request.body += data[i].getAttribute("name")+"="+data[i].options[data[i].selectedIndex].value+"&";
			else
				request.body += data[i].getAttribute("name")+"="+data[i].options[data[i].selectedIndex].value;
		}

		return request;
	}
}
