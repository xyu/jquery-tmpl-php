<table>
    <thead>
        <tr>
            <th>Movie Name</th>
            <th>Release Year</th>
            <th>Director</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
{{each movies}}
        <tr>
            <td>${this.name}</td>
            <td>${this.year}</td>
            <td>${this.director}</td>
            <td>{{tmpl "#ratingTemplate"}}</td>
        </tr>
{{/each}}
    </tbody>
</table>
