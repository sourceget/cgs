---
title: API参考手册

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---

# Info

Welcome to the generated API reference.

# Available routes
#general
## api/user/list

> 请求实例:

```bash
curl "http://cgs.xincap.com/api/user/list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://cgs.xincap.com/api/user/list",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> 返回实例:

```json
{
    "code": 200,
    "items": [
        {
            "id": 1,
            "name": "\u9648\u5fb7\u534e",
            "email": "mr.sk@qq.com",
            "created_at": "2016-05-30 15:12:57",
            "updated_at": "2016-05-30 15:26:02"
        }
    ]
}


```

### HTTP Request
`GET api/user/list`

`HEAD api/user/list`


