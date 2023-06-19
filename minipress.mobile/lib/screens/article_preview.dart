import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import '../models/article.dart';

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
      onTap: () {
        print("click");
      },
    );
  }
}