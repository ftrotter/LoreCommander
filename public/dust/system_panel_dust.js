(function(dust){dust.register("system_panel_dust",body_0);function body_0(chk,ctx){return chk.w("        <div class=\"panel panel-default\"><div class=\"panel-heading\"><h4><a target='_blank' href='/CareSetReport/SOCkSystemReport/").f(ctx.get(["system_id"], false),ctx,"h").w("/'>").f(ctx.get(["system_name"], false),ctx,"h").w("</a></h4></div><div class=\"panel-body\"><ul class=\"list-group\"><li class=\"list-group-item\"><b>Full Name:</b> <br> ").f(ctx.get(["full_system"], false),ctx,"h").w("</li><li class=\"list-group-item\"><b>Domain:</b><br><small><a target='_blank' href='http://").f(ctx.get(["system_domain"], false),ctx,"h").w("'>").f(ctx.get(["system_domain"], false),ctx,"h").w("</a></small></li><li class=\"list-group-item\"><b>City:</b><br> ").f(ctx.get(["system_city"], false),ctx,"h").w(", ").f(ctx.get(["system_state"], false),ctx,"h").w("</li><li class=\"list-group-item\"><b>Org Count:</b> <br> ").f(ctx.get(["cache_onpi_provider_count"], false),ctx,"h").w("</li>\t<li class=\"list-group-item\"><b>Person Count:</b> <br> ").f(ctx.get(["cache_onpi_provider_count"], false),ctx,"h").w("</li>\t<li class=\"list-group-item\"><b>Operating In:</b> <br> ").f(ctx.get(["cache_state_list"], false),ctx,"h").w("</li>\t</ul></div></div>");}body_0.__dustBody=!0;return body_0;})(dust);