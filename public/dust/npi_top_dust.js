(function(dust){dust.register("npi_top_dust",body_0);function body_0(chk,ctx){return chk.w("    <div class=\"container\"><section id=\"top\"><!-- Main hero unit for a primary marketing message or call to action --><div class=\"row\"><div class=\"col-md-9\"><div class=\"jumbotron\"><div class=\"row\"><div class=\"col-md-6\"><h2>").f(ctx.get(["print_name"], false),ctx,"h").w("</h2><p>Everything you always wanted to know about ").f(ctx.get(["print_name"], false),ctx,"h").w(" but were afraid to ask.</p></div><div class=\"col-md-6\"><h1>").f(ctx.get(["npi"], false),ctx,"h").w("</h1></div></div></div></div><div class=\"col-md-3\"><div class=\"panel panel-default\"><div class=\"panel-heading\"><h3>Latest Note</div><div class=\"panel-body\">(coming soon)").f(ctx.get(["latest_note"], false),ctx,"h").w("<br><br><br><br></div><div class=\"panel-footer\"><a class=\"btn btn-primary btn-sm disabled\">New Note</a><a class=\"btn btn-primary btn-sm disabled \">View All Notes</a></div></div></div></div></section><ul class=\"nav nav-tabs\"><li ").x(ctx.get(["summary_view"], false),ctx,{"block":body_1},{}).w("><a href=\"/npi/").f(ctx.get(["npi"], false),ctx,"h").w("\"></a></li><li ").x(ctx.get(["shared_view"], false),ctx,{"block":body_2},{}).w(">").h("gt",ctx,{"else":body_3,"block":body_4},{"key":ctx.get(["total_shared_data"], false),"value":0}).w("</li></ul><br>");}body_0.__dustBody=!0;function body_1(chk,ctx){return chk.w(" class='active' ");}body_1.__dustBody=!0;function body_2(chk,ctx){return chk.w(" class='active' ");}body_2.__dustBody=!0;function body_3(chk,ctx){return chk.w("<a class=\"disabled\" href=\"#\"><span class=\"glyphicon glyphicon-remove red\"></span>No Shared</a>");}body_3.__dustBody=!0;function body_4(chk,ctx){return chk.w("<a href=\"/npi/").f(ctx.get(["npi"], false),ctx,"h").w("/shared/\"><span class=\"glyphicon glyphicon-ok white\"></span>Shared</a>");}body_4.__dustBody=!0;return body_0;})(dust);