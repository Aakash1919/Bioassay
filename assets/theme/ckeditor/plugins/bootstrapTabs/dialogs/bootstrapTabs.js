﻿CKEDITOR.dialog.add("bootstrapTabsDialog", function(b) {
    return {
        title: b.lang.bootstrapTabs.dialogTitle,
        minWidth: 310,
        minHeight: 280,
        contents: [{
            id: "tab-basic",
            label: b.lang.bootstrapTabs.tabBasicLabel,
            elements: [{
                type: "html",
                html: b.lang.bootstrapTabs.infoHtml
            }, {
                type: "text",
                id: "tab-set-title",
                label: b.lang.bootstrapTabs.tabSetTitleLabel,
                validate: CKEDITOR.dialog.validate.notEmpty(b.lang.bootstrapTabs.invalidTabSetTitle),
                setup: function(a) {
                    a = a.data("tab-set-title");
                    this.setValue(a)
                }
            }, {
                type: "select",
                id: "number-of-tabs",
                label: b.lang.bootstrapTabs.numberOfTabsLabel,
                "default": 4,
                items: [
                    ["2"],
                    ["3"],
                    ["4"],
                    ["5"],
                    ["6"],
                    ["7"],
                    ["8"],
                    ["9"]
                ],
                validate: CKEDITOR.dialog.validate.notEmpty(b.lang.bootstrapTabs.invalidNumberOfTabs),
                setup: function(a) {
                    a = a.find(".nav.nav-tabs li a.tab-link").count();
                    this.setValue(a)
                }
            }, {
                type: "html",
                html: '\x3chr style\x3d"display: block;position: relative;padding: 0;margin: 8px auto;width: 100%;max-height: 0;font-size: 1px;line-height: 0;clear: both;border: none;border-top: 1px solid #aaaaaa;border-bottom: 1px solid #ffffff;"/\x3e'
            }, {
                type: "select",
                id: "tab-to-remove",
                label: b.lang.bootstrapTabs.removeTabLabel,
                "default": b.lang.bootstrapTabs.removeTabDefault,
                items: [
                    [b.lang.bootstrapTabs.removeTabDefault]
                ],
                setup: function(a) {
                    this.clear().add(b.lang.bootstrapTabs.removeTabDefault);
                    a = a.findOne(".nav.nav-tabs").find("li");
                    for (i = 0; i < a.count(); i++) this.add(a.getItem(i).findOne("a.tab-link").getText())
                }
            }]
        }],
        onShow: function() {
            var a = b.getSelection().getStartElement();
            a && (ascendant = a.getAscendant(function(a) {
                return a instanceof CKEDITOR.dom.document ?
                    !1 : a.hasClass("bootstrap-tabs")
            }));
            ascendant ? (this.insertMode = !1, a = ascendant) : this.insertMode = !0;
            this.element = a;
            this.insertMode || this.setupContent(a)
        },
        onOk: function() {
            var a = this.getValueOf("tab-basic", "number-of-tabs"),
                e = this.getValueOf("tab-basic", "tab-set-title"),
                g = this.getValueOf("tab-basic", "tab-to-remove");
            if (this.insertMode) {
                d = CKEDITOR.dom.element.createFromHtml('\x3cdiv class\x3d"bootstrap-tabs"\x3e\x3cul class\x3d"nav nav-tabs" role\x3d"tablist"\x3e\x3c!-- add tabs here --\x3e\x3c/ul\x3e\x3cdiv class\x3d"tab-content"\x3e\x3c!-- add tab panels here --\x3e\x3c/div\x3e\x3c/div\x3e');
                for (c = 1; c <= a; c++) appendTabToElement(b, this, d, a, c);
                b.insertElement(d)
            } else {
                var d = this.element,
                    f = d.find(".nav.nav-tabs li a.tab-link").count();
                d.data("tab-set-title");
                for (var k = d.findOne("ul.nav.nav-tabs"), l = d.findOne("div.tab-content"), h = k.find("li"), m = l.find("div.tab-pane"), c = 0; c < h.count(); c++) g === h.getItem(c).findOne("a.tab-link").getText() && h.count() === m.count() && (h.getItem(c).remove(), m.getItem(c).remove());
                if (a > f) {
                    k.findOne(".active").removeClass("active");
                    l.findOne(".active").removeClass("active");
                    for (var c = f + 1; c <= a; c++) appendTabToElement(b, this, d, a, c)
                }
            }
            d.data("tab-set-title", e)
        }
    }
});

function appendTabToElement(b, a, e, g, d) {
    a = a.getValueOf("tab-basic", "tab-set-title");
    b = "Tab " + d;
    var f = (a + " " + b).replace(/(\W+|\s+|_|-+)/g, "-").replace(/-+/g, "-").toLowerCase();
    a = '\x3cdiv role\x3d"tabpanel" class\x3d"tab-pane" id\x3d"' + f + '"\x3e' + ('\x3cdiv class\x3d"tab-pane-content"\x3e' + b + " Content\x3c/div\x3e") + "\x3c/div\x3e";
    b = new CKEDITOR.dom.element.createFromHtml('\x3cli role\x3d"presentation"\x3e\x3ca class\x3d"tab-link" href\x3d"#' + f + '" aria-controls\x3d"' + f + '" role\x3d"tab" data-toggle\x3d"tab"\x3e' +
        b + " Name\x3c/a\x3e\x3c/li\x3e");
    a = new CKEDITOR.dom.element.createFromHtml(a);
    d == g && (b.addClass("active"), a.addClass("active"));
    g = e.findOne("ul.nav.nav-tabs");
    e = e.findOne("div.tab-content");
    g.append(b);
    e.append(a)
};