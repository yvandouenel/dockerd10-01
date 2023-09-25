
(function ($, Drupal, once) {
  Drupal.behaviors.library_books_fetch = {
    attach: function attach(context) {
      once('library_books_fetch', '#manage-books-section', context).forEach(function (value) {
        console.log(`Dans fetch.js`);
        $(".delete-api").on("click", (event) => {
          event.preventDefault();
          const id = $(event.target).attr("data-id");
          console.log(`id to delete : `, id);

          (async function () {
            const drupal_token = await fetch(`http://localhost:8082/session/token/`, {
              method: 'GET',
              credentials: 'include',
              headers: {
                "Content-type": "application/json; charset=UTF-8",
              },
            })
              .then((response) => {
                console.log(`response.status`, response.status);
                return response.text();
              })
              .then((token) => {
                return token
              }).catch((err) => {
                console.log(err);
              });
            console.log(`drupal_token : `, drupal_token);
            if (confirm("Etes-vous sûr.e de vouloir supprimer ce livre?")) {

              const url = `http://localhost:8082/library-books/${id}`;
              await fetch(url, {
                method: 'DELETE',
                credentials: 'include',
                headers: {
                  "Content-type": "application/json; charset=UTF-8",
                  'X-CSRF-TOKEN': drupal_token
                },
              })
                .then((response) => {
                  console.log(`response.status`, response.status);
                })
                .catch((err) => {
                  console.log(err);
                });
            }
            $("#book-id-" + id).hide(800);

          })();
        })

      });
    }
  };
})(jQuery, Drupal, once);
