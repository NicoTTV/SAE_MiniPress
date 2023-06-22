import 'package:flutter/material.dart';
import '../models/article.dart';
import 'article_details.dart';

class ArticlePreview extends StatefulWidget {
  final Article article;

  const ArticlePreview({super.key, required this.article});
  @override
  State<ArticlePreview> createState() => _ArticlePreview();
}

class _ArticlePreview extends State<ArticlePreview> {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: Container(
        decoration: const BoxDecoration(
            border: Border(bottom: BorderSide(color: Color(0xFFFF595A)))),
        child: ListTile(
          textColor: Colors.black,
          title: Text(widget.article.titre),
          subtitle: Column(
            children: [
              Text(widget.article.dateCreation),
              Text(widget.article.auteur)
            ],
          ),
          onTap: () async {
            await Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => ArticleDetails(article: widget.article))
        );
          },
        ),
      ),
    );
  }
}
