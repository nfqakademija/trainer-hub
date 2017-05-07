var $addTagLink = $('<a href="#" class="add_date_link">Pridėti naują laiką</a>');
var $newLinkLi = $('<p></p>').append($addTagLink);

jQuery(document).ready(function() {
    var $collectionHolder = $('ul.date');
    $collectionHolder.append($newLinkLi);


    $collectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagLink.on('click', function(e) {
        e.preventDefault();

        // add a new date form (see code block below)
        addDateForm($collectionHolder, $newLinkLi);
    });


});

function addDateForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);

    $newLinkLi.before($newFormLi);
    addTagFormDeleteLink($newFormLi);

    // handle the removal
    $('.remove-date').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#">x</a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}