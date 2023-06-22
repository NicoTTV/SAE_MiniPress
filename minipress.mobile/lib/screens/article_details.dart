import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article_provider.dart';
import 'package:provider/provider.dart';
import '../models/article.dart';

class ArticleDetails extends StatefulWidget {
  final Article article;

  const ArticleDetails({Key? key, required this.article}) : super(key: key);

  @override
  State<ArticleDetails> createState() => _ArticleDetails();
}

class _ArticleDetails extends State<ArticleDetails> {

  @override
  Widget build(BuildContext context) {
    Provider.of<ArticleProvider>(context, listen: false).fetchDetailsArticle(widget.article.lienDetails['self']['href']);
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
                    const SizedBox(height: 20),
                    Container(
                      decoration: const BoxDecoration(
                        border: Border(bottom: BorderSide(color: Colors.black))
                      ),
                      child: Text(
                        snapshot.data['titre'],
                        style: const TextStyle(
                          fontWeight: FontWeight.bold,
                          fontSize: 48 
                        ),
                      ),
                    ),
                    const SizedBox(height: 40),
                    Column(
                      children: [
                        const Text(
                          'Résumé de l\'article :',
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 24
                          ),
                        ),
                        Text(
                          snapshot.data['resume'],
                          style: const TextStyle(
                            fontSize: 18
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 20),
                    Column(
                      children: [
                        const Text(
                          'Contenu :',
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 24
                          ),
                        ),
                        Text(
                          snapshot.data['contenu'],
                          style: const TextStyle(
                            fontSize: 18
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 50),
                    Text(
                      ' - Article écrit le ${snapshot.data['date_de_creation']}',
                      style: const TextStyle(
                        fontSize: 12
                      )
                    )
                  ],
                );
              }
              else {
                return const CircularProgressIndicator();
              }
            })
          );
        },
      )
    );
  }  
}