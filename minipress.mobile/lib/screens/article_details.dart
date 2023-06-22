import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article_provider.dart';
import 'package:provider/provider.dart';
import '../models/article.dart';
import 'package:flutter_markdown/flutter_markdown.dart';

class ArticleDetails extends StatefulWidget {
  final Article article;

  const ArticleDetails({Key? key, required this.article}) : super(key: key);

  @override
  State<ArticleDetails> createState() => _ArticleDetails();
}

class _ArticleDetails extends State<ArticleDetails> {
  @override
  Widget build(BuildContext context) {
    Provider.of<ArticleProvider>(context, listen: false)
        .fetchDetailsArticle(widget.article.lienDetails['self']['href']);
    return Scaffold(
        appBar: AppBar(
          title: const Text('Détails de l\'article'),
        ),
        body: Consumer<ArticleProvider>(
          builder: (BuildContext context, articleProvider, child) {
            return FutureBuilder(
                future: articleProvider.readArticle(),
                builder: ((context, snapshot) {
                  if (snapshot.hasData) {
                    return Column(
                      children: [
                        Text(
                          snapshot.data['titre'],
                          style: const TextStyle(
                              fontWeight: FontWeight.bold, fontSize: 48),
                        ),
                        Column(
                          children: [
                            const Text(
                              'Résumé de l\'article :',
                              style: TextStyle(
                                  fontWeight: FontWeight.bold, fontSize: 24),
                            ),
                            MarkdownBody(data: snapshot.data['resume']),
                          ],
                        ),
                        Column(
                          children: [
                            const Text(
                              'Contenu :',
                              style: TextStyle(
                                  fontWeight: FontWeight.bold, fontSize: 24),
                            ),
                            MarkdownBody(
                              data: snapshot.data['contenu'],
                            ),
                          ],
                        ),
                        Text(
                            ' - Article écrit le ${snapshot.data['date_de_creation']}',
                            style: const TextStyle(fontSize: 12))
                      ],
                    );
                  } else {
                    return const CircularProgressIndicator();
                  }
                }));
          },
        ));
  }
}
