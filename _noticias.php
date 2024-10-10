<div class="panel panel-default no-border-radius">
    <div class="panel-heading">
        <div class="e_titulo_c">
            <span class="panel-title"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;&nbsp;Últimas Notícias</span>&nbsp;&nbsp;
                <a href="/noticias/">
                    <div class="e_link_ver_mais">
                        <div class="e_icone_link"><hr></div>
                        <div class="e_info_link e_lato_bold"><span>VER TODAS AS NOTÍCIAS</span></div>
                    </div>
                </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="panel-body no-p">
        
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                padding: 20px;
            }
    
            .feed-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 20px;
            }
    
            .post {
                background-color: white;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                width: calc(33.333% - 20px); /* Exibe três posts paralelamente */
                display: flex;
                flex-direction: column;
            }
    
            .post-title {
                font-size: 1.2em;
                margin-bottom: 10px;
                color: #3498db;
                text-decoration: none;
            }
    
            .post-summary {
                font-size: 0.9em;
                color: #555;
                margin-bottom: 10px;
            }
    
            .post-date {
                font-size: 0.8em;
                color: gray;
                margin-top: auto;
            }
    
            .no-posts {
                font-size: 1.2em;
                text-align: center;
                margin-top: 20px;
            }
        </style>
        
        <div class="feed-container" id="rss-feed">
            <!-- Os posts serão inseridos aqui dinamicamente -->
        </div>
    
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const feedUrl = 'https://baixagrandedoribeiro.pi.leg.br/noticias/rss/latest-posts'; // Substitua pela URL do feed RSS desejado
    
                fetchFeed(feedUrl);
    
                function fetchFeed(url) {
                    fetch(`https://api.rss2json.com/v1/api.json?rss_url=${encodeURIComponent(url)}`)
                        .then(response => response.json())
                        .then(data => displayFeed(data))
                        .catch(error => console.error('Erro ao carregar o feed:', error));
                }
    
                function displayFeed(feedData) {
                    const rssFeedElement = document.getElementById('rss-feed');
                    
                    if (feedData.items.length === 0) {
                        // Caso não haja posts no feed
                        const noPostsMessage = document.createElement('div');
                        noPostsMessage.classList.add('no-posts');
                        noPostsMessage.textContent = 'Nenhum post encontrado.';
                        rssFeedElement.appendChild(noPostsMessage);
                        return;
                    }
    
                    // Limita a exibição a 6 itens no máximo
                    const maxItems = 6;
                    const itemsToDisplay = feedData.items.slice(0, maxItems);
    
                    itemsToDisplay.forEach(post => {
                        // Cria um contêiner para cada post
                        const postElement = document.createElement('div');
                        postElement.classList.add('post');
    
                        // Adiciona o título como link
                        const title = document.createElement('a');
                        title.href = post.link;
                        title.classList.add('post-title');
                        title.textContent = post.title;
                        postElement.appendChild(title);
    
                        // Adiciona o sumário (limite de 200 caracteres)
                        const summary = document.createElement('div');
                        summary.classList.add('post-summary');
                        summary.textContent = post.description.substring(0, 200) + (post.description.length > 200 ? '...' : '');
                        postElement.appendChild(summary);
    
                        // Adiciona a data de publicação
                        const pubDate = document.createElement('div');
                        pubDate.classList.add('post-date');
                        pubDate.textContent = `Publicado em: ${new Date(post.pubDate).toLocaleDateString()}`;
                        postElement.appendChild(pubDate);
    
                        // Adiciona a data de atualização, se houver
                        if (post.updated) {
                            const updateDate = document.createElement('div');
                            updateDate.classList.add('post-date');
                            updateDate.textContent = `Atualizado em: ${new Date(post.updated).toLocaleDateString()}`;
                            postElement.appendChild(updateDate);
                        }
    
                        rssFeedElement.appendChild(postElement);
                    });
                }
            });
        </script>
    </div>
</div>
