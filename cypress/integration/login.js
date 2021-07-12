it('Logs in users', () => {
    cy.create('App\\Models\\User').then(user => {
        cy.visit('/login');

        cy.userLogin(user);

        cy.contains(user.first_name);
    });
});
