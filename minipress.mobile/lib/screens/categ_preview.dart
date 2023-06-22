import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article_provider.dart';
import 'package:minipress_mobile/models/categorie.dart';
import 'package:provider/provider.dart';

class CategPreview extends StatefulWidget {
  final Categorie categorie;

  const CategPreview({super.key, required this.categorie});
  @override
  State<CategPreview> createState() => _CategPreview();
}

class _CategPreview extends State<CategPreview> {
  @override
  Widget build(BuildContext context) {
    var articleProvider = context.watch<ArticleProvider>();
    return Container(
      margin: const EdgeInsets.all(8),
      child: TextButton(
          onPressed: () {
            articleProvider
                .fetchArticleByCategorie(widget.categorie.idCategorie);
          },
          child: SizedBox(
              width: 80, child: Center(child: Text(widget.categorie.titre)))),
    );
  }
}
