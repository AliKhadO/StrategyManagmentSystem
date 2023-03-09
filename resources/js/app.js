import { delay } from "lodash";
import "./bootstrap";

$(function () {
    $(".sidenav .collapse").each((idx, collapsable) => {
        collapsable.addEventListener("show.bs.collapse", function () {
            localStorage.setItem("toggle." + collapsable.id, true);
        });
        collapsable.addEventListener("hide.bs.collapse", function () {
            localStorage.setItem("toggle." + collapsable.id, false);
        });
    });

    $(".sidenav .collapse").each((idx, collapsable) => {
        let collapsableItem = localStorage.getItem("toggle." + collapsable.id);
        console.log(collapsableItem);
        var bsCollapse = new bootstrap.Collapse(collapsable, {
            toggle: false,
        });
        if (collapsableItem == "true") {
            bsCollapse.show();
        } else bsCollapse.hide();
    });

    $(document).on("click", ".with-confirm", function (event) {
        return confirm('Are you sure want to continue?');
    });
});
