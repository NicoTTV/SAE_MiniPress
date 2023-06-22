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
    return ListTile(
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
    );
  }
}
